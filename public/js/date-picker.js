var shbdp_format = 'DD/MM/YYYY';
	var shbdp_format_placeholder = 'DD/MM/YYYY';
	var shb_booking_page_url = 'https://pbdaccommodation.mptourism.com/bookings/';
	var shb_err_msg_dates = 'Please select a check in and check out date';
	var shb_err_msg_guests = 'Please select at least 1 guest';
	var shb_datepicker_daynames = ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];
	var shb_datepicker_monthnames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

jQuery(document).ready(function ($) {
    "use strict";

    var shbdp_settings = {
        dateformat: shbdp_format,
        dateformatplaceholder: shbdp_format_placeholder,
    };

    // Only load if datepicker exists on page
    if (jQuery(".shbdp-checkin")[0]) {
        shbdp(shbdp_settings);
    }
});

function shbdp(settings) {
    function shbdp_load_all() {
        jQuery(
            ".shbdp-cal-available, .shbdp-cal-available-checkout-only"
        ).click(function () {
            if (
                jQuery(".shbdp-checkin").val().length !== 0 &&
                jQuery(".shbdp-checkout").val().length !== 0 &&
                jQuery(this).hasClass("shbdp-cal-available-checkout-only")
            ) {
                return false;
            }

            if (jQuery(this).hasClass("shbdp-cal-disabled")) {
                return false;
            }

            if (
                jQuery(".shbdp-checkin").val().length !== 0 &&
                jQuery(".shbdp-checkout").val().length !== 0
            ) {
                shbdp_clear_selection();
            }

            var date = jQuery(this).attr("data-date");

            if (jQuery(".shbdp-checkin").val().length == 0) {
                if (
                    !jQuery(this).hasClass("shbdp-cal-available-checkout-only")
                ) {
                    jQuery(".shbdp-checkout-display").html("...");
                    jQuery(".shbdp-checkin-display").html(
                        shbdp_dateformat(date)
                    );
                    jQuery(".shbdp-checkin").val(date);

                    var selectable_date_range =
                        shbdp_selectable_date_range(date);

                    jQuery(".shbdp-min").val(
                        selectable_date_range["newest_date"]
                    );
                    jQuery(".shbdp-max").val(
                        selectable_date_range["oldest_date"]
                    );

                    shbdp_selectable_date_range_css(
                        jQuery(".shbdp-checkin").val()
                    );
                    shbdp_live_selection_hover_css(date);

                    var max = jQuery(".shbdp-max").val();
                    var shbdp_position_data = shbdp_position();

                    jQuery(".shbdp-cal-wrapper").css(
                        "top",
                        shbdp_position_data["checkout_vert_position"]
                    );
                }
            } else {
                if (
                    date !== jQuery(".shbdp-checkin").val() &&
                    date > jQuery(".shbdp-checkin").val() &&
                    (date <= jQuery(".shbdp-max").val() ||
                        jQuery(".shbdp-max").val() == "")
                ) {
                    jQuery(".shbdp-checkout-display").html(
                        shbdp_dateformat(date)
                    );
                    jQuery(".shbdp-checkout").val(date);

                    shbdp_reset_selectable_blocked_dates();

                    jQuery(this).addClass("shbdp-cal-selected-checkout");

                    jQuery(".shbdp-cal-wrapper").fadeOut(200);
                }
            }
        });
    }

    function shbdp_clear_selection() {
        jQuery(".shbdp-checkin-display,.shbdp-checkout-display").html(
            settings["dateformatplaceholder"]
        );
        jQuery(".shbdp-checkin,.shbdp-checkout,.shbdp-min,.shbdp-max").val("");
        jQuery(".shbdp-cal-wrapper table tbody tr td").removeClass(
            "shbdp-cal-selected-checkin shbdp-cal-selected-checkout shbdp-cal-selected-date shbdp-cal-available-checkout-only-live"
        );
    }

    function shbdp_selectable_date_range(checkin) {
        var before_unavailable = [];
        var after_unavailable = [];

        jQuery(".shbdp-cal-wrapper table tbody tr td").each(function () {
            var date = jQuery(this).attr("data-date");

            if (date < checkin) {
                if (jQuery(this).hasClass("shbdp-cal-unavailable")) {
                    before_unavailable.push(date);
                }
            }

            if (date > checkin) {
                if (jQuery(this).hasClass("shbdp-cal-unavailable")) {
                    after_unavailable.push(date);
                }
            }
        });

        before_unavailable_sorted = before_unavailable.sort();
        after_unavailable_sorted = after_unavailable.sort();

        var selectable_date_range = {};
        selectable_date_range["newest_date"] =
            before_unavailable_sorted.slice(-1)[0];
        selectable_date_range["oldest_date"] = after_unavailable_sorted[0];

        return selectable_date_range;
    }

    function shbdp_nav() {
        var panels = jQuery(".shbdp-cal-wrapper").attr("data-panels");

        if (panels == 1) {
            jQuery(".shbdp-cal .shbdp-item:nth-child(1)").addClass(
                "shbdp-item-open-1"
            );
        } else {
            jQuery(".shbdp-cal .shbdp-item:nth-child(1)").addClass(
                "shbdp-item-open-1"
            );
            jQuery(".shbdp-cal .shbdp-item:nth-child(2)").addClass(
                "shbdp-item-open-2"
            );
        }

        jQuery(".shbdp-nav-prev").on("click", function () {
            if (
                !jQuery(".shbdp-cal")
                    .children(".shbdp-item")
                    .eq(0)
                    .hasClass("shbdp-item-open-1")
            ) {
                jQuery(".shbdp-cal")
                    .children(".shbdp-item-open-1")
                    .eq(0)
                    .prev()
                    .addClass("shbdp-item-open-1");
                jQuery(".shbdp-cal")
                    .children(".shbdp-item-open-1")
                    .eq(1)
                    .removeClass("shbdp-item-open-1");
                jQuery(".shbdp-cal")
                    .children(".shbdp-item-open-2")
                    .eq(0)
                    .prev()
                    .addClass("shbdp-item-open-2");
                jQuery(".shbdp-cal")
                    .children(".shbdp-item-open-2")
                    .eq(1)
                    .removeClass("shbdp-item-open-2");
            }

            return false;
        });

        jQuery(".shbdp-nav-next").on("click", function () {
            if (
                !jQuery(".shbdp-cal")
                    .children(".shbdp-item")
                    .last()
                    .hasClass("shbdp-item-open-1") &&
                !jQuery(".shbdp-cal")
                    .children(".shbdp-item")
                    .last()
                    .hasClass("shbdp-item-open-2")
            ) {
                jQuery(".shbdp-cal")
                    .children(".shbdp-item-open-1")
                    .eq(0)
                    .next()
                    .addClass("shbdp-item-open-1");
                jQuery(".shbdp-cal")
                    .children(".shbdp-item-open-1")
                    .eq(0)
                    .removeClass("shbdp-item-open-1");
                jQuery(".shbdp-cal")
                    .children(".shbdp-item-open-2")
                    .eq(0)
                    .next()
                    .addClass("shbdp-item-open-2");
                jQuery(".shbdp-cal")
                    .children(".shbdp-item-open-2")
                    .eq(0)
                    .removeClass("shbdp-item-open-2");
            }

            return false;
        });
    }

    function shbdp_selectable_date_range_css(checkin) {
        var selectable_date_range = shbdp_selectable_date_range(checkin);

        var newest_date = selectable_date_range["newest_date"];
        var oldest_date = selectable_date_range["oldest_date"];

        jQuery(".shbdp-cal-wrapper table tbody tr td").each(function () {
            var date = jQuery(this).attr("data-date");
            var date_element = jQuery(
                '.shbdp-cal-wrapper table tbody tr td[data-date="' + date + '"]'
            );

            if (date == checkin) {
                date_element.addClass("shbdp-cal-selected-checkin");
            }

            // Disable reverse selection
            if (date < checkin) {
                if (
                    !date_element.hasClass("shbdp-cal-disabled") &&
                    !date_element.hasClass("shbdp-cal-unavailable")
                ) {
                    date_element.addClass("shbdp-cal-disabled-temp");
                }
            }

            if (date < newest_date) {
                if (
                    !date_element.hasClass("shbdp-cal-disabled") &&
                    !date_element.hasClass("shbdp-cal-unavailable")
                ) {
                    date_element.addClass("shbdp-cal-disabled-temp");
                }
            }

            if (date > oldest_date) {
                if (
                    !date_element.hasClass("shbdp-cal-disabled") &&
                    !date_element.hasClass("shbdp-cal-unavailable")
                ) {
                    date_element.addClass("shbdp-cal-disabled-temp");
                }
            }

            if (date == oldest_date) {
                date_element.addClass(
                    "shbdp-cal-available shbdp-cal-available-checkout-only-live"
                );
                date_element.removeClass(
                    "shbdp-cal-unavailable shbdp-cal-available-checkout-only"
                );
            }
        });
    }

    function shbdp_reset_selectable_blocked_dates() {
        jQuery(".shbdp-cal-wrapper table tbody tr td").each(function () {
            if (jQuery(this).hasClass("shbdp-cal-disabled-temp")) {
                jQuery(this).removeClass("shbdp-cal-disabled-temp");
            }

            if (jQuery(this).hasClass("shbdp-cal-selected-date-live")) {
                jQuery(this).removeClass("shbdp-cal-selected-date-live");
                jQuery(this).addClass("shbdp-cal-selected-date");
            }

            if (
                jQuery(this).hasClass("shbdp-cal-available-checkout-only-live")
            ) {
                jQuery(this).removeClass(
                    "shbdp-cal-available shbdp-cal-available-checkout-only-live"
                );
                jQuery(this).addClass(
                    "shbdp-cal-unavailable shbdp-cal-available-checkout-only"
                );
            }
        });
    }

    function shbdp_live_selection_hover_css(checkin) {
        jQuery(".shbdp-cal-wrapper table tbody tr td.shbdp-cal-available").on(
            "mouseover",
            function () {
                if (!jQuery(this).hasClass("shbdp-cal-disabled-temp")) {
                    if (jQuery(".shbdp-checkout").val() == "") {
                        var date = jQuery(this).attr("data-date");

                        if (checkin == date || "" == date) {
                            jQuery(".shbdp-checkout-display").html("...");
                        } else {
                            jQuery(".shbdp-checkout-display").html(
                                shbdp_dateformat(date)
                            );
                        }
                    }

                    var checkin_selected = shbdp_checkin_selected();
                    var checkout_selected = shbdp_checkout_selected();

                    if (
                        checkin !== null &&
                        checkout_selected == false &&
                        checkin_selected !== false
                    ) {
                        var date = jQuery(this).attr("data-date");

                        // shbdp_update_date_notice function causes bug where date must be clicked twice to be selected on mobile devices
                        if (
                            !/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                                navigator.userAgent
                            )
                        ) {
                            //shbdp_update_date_notice(date);
                        }

                        var parent = jQuery(this).closest(".shbdp-cal");
                        var availableChildren = parent.find(
                            ".shbdp-cal-available"
                        );
                        var checkInElement = parent.find(
                            '[data-date="' + checkin + '"]'
                        )[0];

                        var idxOfCurrent = availableChildren.index(
                            jQuery(this)
                        );
                        var idxOfCheckIn =
                            availableChildren.index(checkInElement);

                        var idxStart =
                            idxOfCheckIn > idxOfCurrent
                                ? idxOfCurrent
                                : idxOfCheckIn;
                        var idxEnd =
                            idxStart == idxOfCheckIn
                                ? idxOfCurrent
                                : idxOfCheckIn;
                        var hoverChildren = availableChildren.slice(
                            idxStart,
                            idxEnd + 1
                        );

                        availableChildren.removeClass(
                            "shbdp-cal-selected-date-live"
                        );
                        hoverChildren.addClass("shbdp-cal-selected-date-live");
                    }
                }

                if (jQuery(this).hasClass("shbdp-cal-selected-checkin")) {
                    var checkin_selected = shbdp_checkin_selected();
                    var checkout_selected = shbdp_checkout_selected();

                    if (
                        checkin !== null &&
                        checkout_selected == false &&
                        checkin_selected !== false
                    ) {
                        var parent = jQuery(this).closest(".shbdp-cal");
                        var availableChildren = parent.find(
                            ".shbdp-cal-available"
                        );
                        availableChildren.removeClass(
                            "shbdp-cal-selected-date-live"
                        );
                    }
                }
            }
        );
    }

    function shbdp_checkin_selected() {
        var elements = jQuery(".shbdp-cal-selected-checkin");
        return elements.length > 0;
    }

    function shbdp_checkout_selected() {
        var elements = jQuery(".shbdp-cal-selected-checkout");
        return elements.length > 0;
    }

    function shbdp_dateformat(date) {
        var format = settings["dateformat"];
        var date_parts = date.split("-");

        if (format == "DD/MM/YYYY") {
            var formatted_date =
                date_parts[2] + "/" + date_parts[1] + "/" + date_parts[0];
        }

        if (format == "MM/DD/YYYY") {
            var formatted_date =
                date_parts[1] + "/" + date_parts[2] + "/" + date_parts[0];
        }

        if (format == "YYYY/MM/DD") {
            var formatted_date =
                date_parts[0] + "/" + date_parts[1] + "/" + date_parts[2];
        }

        if (format == "DD.MM.YYYY") {
            var formatted_date =
                date_parts[2] + "." + date_parts[1] + "." + date_parts[0];
        }

        if (format == "MM.DD.YYYY") {
            var formatted_date =
                date_parts[1] + "." + date_parts[2] + "." + date_parts[0];
        }

        if (format == "YYYY.MM.DD") {
            var formatted_date =
                date_parts[0] + "." + date_parts[1] + "." + date_parts[2];
        }

        if (date_parts[1] === undefined) {
            return "...";
        } else {
            return formatted_date;
        }
    }

    function shbdp_preset_dates() {
        var shbdp_checkin = jQuery(".shbdp-checkin").val();
        var shbdp_checkout = jQuery(".shbdp-checkout").val();

        var shbdp_checkin_d = new Date(shbdp_checkin);
        var shbdp_checkout_d = new Date(shbdp_checkout);

        var shbdp_checkin_f = shbdp_dateformat(shbdp_checkin);
        var shbdp_checkout_f = shbdp_dateformat(shbdp_checkout);

        jQuery(".shbdp-checkin-display").html(shbdp_checkin_f);
        jQuery(".shbdp-checkout-display").html(shbdp_checkout_f);

        jQuery('[data-date="' + shbdp_checkin + '"]').addClass(
            "shbdp-cal-selected-checkin"
        );
        jQuery('[data-date="' + shbdp_checkout + '"]').addClass(
            "shbdp-cal-selected-checkout"
        );

        var shbdp_range = [];

        do {
            shbdp_checkin_d.setDate(shbdp_checkin_d.getDate() + 1);
            shbdp_range.push(shbdp_format_date(shbdp_checkin_d));
        } while (
            shbdp_format_date(shbdp_checkin_d) !==
            shbdp_format_date(shbdp_checkout_d)
        );

        shbdp_range.splice(-1, 1);

        jQuery.each(shbdp_range, function (index, val) {
            jQuery('[data-date="' + val + '"]').addClass(
                "shbdp-cal-selected-date"
            );
        });
    }

    shbdp_nav();

    if (
        jQuery(".shbdp-checkin").val().length == 0 &&
        jQuery(".shbdp-checkout").val().length == 0
    ) {
        shbdp_clear_selection();
    } else {
        shbdp_preset_dates();
    }

    shbdp_load_all();
    shbdp_open_close();
    shbdp_click_off();
}

function shbdp_format_date(date) {
    var d = new Date(date),
        month = "" + (d.getMonth() + 1),
        day = "" + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = "0" + month;
    if (day.length < 2) day = "0" + day;

    return [year, month, day].join("-");
}

function shbdp_position() {
    if (!jQuery(".shb-booking-form-wrapper-inner .shbdp-cal-wrapper")[0]) {
        var shbdp_ci_p = jQuery(".shbdp-checkin-wrapper").position();
        var shbdp_ci_h = jQuery(".shbdp-checkin-wrapper").outerHeight();
        var shbdp_ci_t = shbdp_ci_p.top;
        var shbdp_ci_l = shbdp_ci_p.left;
        var shbdp_ci_r = 0;

        var shbdp_co_p = jQuery(".shbdp-checkout-wrapper").position();
        var shbdp_co_h = jQuery(".shbdp-checkout-wrapper").outerHeight();
        var shbdp_co_t = shbdp_co_p.top;
        var shbdp_co_l = shbdp_co_p.left;
        var shbdp_co_r = 0;

        var position = {};
        position["checkin_top"] = shbdp_ci_t + "px";
        position["checkin_left"] = shbdp_ci_l + "px";
        position["checkin_right"] = shbdp_ci_r + "px";
        position["checkin_height"] = shbdp_ci_h + "px";
        position["checkin_vert_position"] = shbdp_ci_t + shbdp_ci_h + "px";
        position["checkout_top"] = shbdp_co_t + "px";
        position["checkout_left"] = shbdp_co_l + "px";
        position["checkout_right"] = shbdp_co_r + "px";
        position["checkout_height"] = shbdp_co_h + "px";
        position["checkout_vert_position"] = shbdp_co_t + shbdp_co_h + "px";
    } else {
        var position = {};
        position["checkin_top"] = 0 + "px";
        position["checkin_left"] = 0 + "px";
        position["checkin_right"] = 0 + "px";
        position["checkin_height"] = 0 + "px";
        position["checkin_vert_position"] = 0 + "px";
        position["checkout_top"] = 0 + "px";
        position["checkout_left"] = 0 + "px";
        position["checkout_right"] = 0 + "px";
        position["checkout_height"] = 0 + "px";
        position["checkout_vert_position"] = 0 + "px";
    }

    return position;
}

function shbdp_open_close() {
    jQuery(".shbdp-cal-wrapper").css("display", "none");

    jQuery(".shbdp-checkin-wrapper, .shbdp-checkout-wrapper").click(
        function () {
            var shbdp_position_data = shbdp_position();

            jQuery(".shbdp-cal-wrapper").fadeIn(300);
            jQuery(".shbdp-cal-wrapper").css(
                "top",
                shbdp_position_data["checkin_vert_position"]
            );
            jQuery(".shbdp-cal-wrapper").css(
                "left",
                shbdp_position_data["checkin_left"]
            );

            // Off screen
            if (shbdp_off_screen(".shbdp-cal-wrapper") == true) {
                jQuery(".shbdp-cal-wrapper").css({
                    right: shbdp_position_data["checkin_right"],
                    left: "inherit",
                });
            }
        }
    );

    jQuery(window).on("load scroll resize", function () {
        var shbdp_position_data = shbdp_position();

        jQuery(".shbdp-cal-wrapper").css(
            "top",
            shbdp_position_data["checkin_vert_position"]
        );
        jQuery(".shbdp-cal-wrapper").css(
            "left",
            shbdp_position_data["checkin_left"]
        );

        // Off screen
        if (shbdp_off_screen(".shbdp-cal-wrapper") == true) {
            jQuery(".shbdp-cal-wrapper").css({
                right: shbdp_position_data["checkin_right"],
                left: "inherit",
            });
        }

        if (
            jQuery(".shbdp-checkin").val().length !== 0 &&
            jQuery(".shbdp-checkout").val().length == 0
        ) {
            jQuery(".shbdp-cal-wrapper").css(
                "top",
                shbdp_position_data["checkout_vert_position"]
            );
        }
    });
}

function shbdp_click_off() {
    jQuery(document).mouseup(function (e) {
        var container = jQuery(
            ".shbdp-cal-wrapper, .shbdp-checkin-wrapper, .shbdp-checkout-wrapper"
        );

        if (!container.is(e.target) && container.has(e.target).length === 0) {
            jQuery(".shbdp-cal-wrapper").fadeOut(200);
        }
    });
}

function shbdp_off_screen(input) {
    var elm = jQuery(input);
    var off = elm.offset();
    var l = off.left;
    var w = elm.width();
    var docW = jQuery("body").width();

    var isEntirelyVisible = l + w <= docW;

    if (!isEntirelyVisible) {
        // off screen
        return true;
    } else {
        // not off screen
        return false;
    }
}
