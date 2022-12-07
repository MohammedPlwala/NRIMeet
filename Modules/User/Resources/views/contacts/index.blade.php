@extends('admin.layouts.app')

@section('content')
@php
    $userPermission = \Session::get('userPermission');
@endphp
	<div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Contacts</h3>
                <p>You have total <span class="record_count">{{ $contactsCount }}</span> Contacts.</p>
            </div><!-- .nk-block-head-content -->
            
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    
    <div class="nk-block table-compact">
        <!--  Filter Tag List -->
        <div id="filter_tag_list" class="filter-tag-list"></div>
        <!-- -->
        <div class="nk-tb-list is-separate mb-3">
            <table class="broadcast-init nowrap nk-tb-list is-separate" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col nk-tb-col-check">
                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                <input type="checkbox" class="custom-control-input" id="check-all" name="check_all"><label class="custom-control-label" for="check-all"></label>
                            </div>
                        </th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Name</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Email</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Contact Number</span></th>
                        <th class="nk-tb-col tb-col-md w-1 text-center" nowrap="true"><span class="sub-text">Message</span></th>
                        <th class="nk-tb-col tb-col-md w-1" nowrap="true"><span class="sub-text">Created At</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-right w-1" nowrap="true">
                            <span class="sub-text">Action</span>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div><!-- .nk-block -->
        <div class="modal fade zoom" tabindex="-1" id="modalFilterUser">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Filter</h5>
                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <form role="form" class="mb-0" method="get" action="#">
                    @csrf
                    <div class="modal-body modal-body-lg">
                        <div class="gy-3">
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="First Name" for="firstName" suggestion="Specify the name of the user." />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="" for="firstName" icon="user" placeholder="Name" name="name"/>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Mobile Number" for="contact_number" suggestion="Specify the mobile number of the user."  />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="" for="contact_number" icon="call" placeholder="Mobile Number" name="contact_number"
                                    data-parsley-pattern="{{ \Config::get('constants.REGEX.VALIDATE_MOBILE_NUMBER_LENGTH') }}"
                                    />
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Created at" for="createdAt" suggestion="Select the dates of created at." />
                                </div>
                                <div class="col-lg-7">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-left">
                                                    <em class="icon ni ni-calendar"></em>
                                                </div>
                                                <input type="text" class="form-control date-picker" placeholder="Form Date" data-date-format="yyyy-mm-dd" id="fromDate" name="fromDate">
                                            </div>
                                            <!-- <div class="form-note mt-0">Form Date</div> -->
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-left">
                                                    <em class="icon ni ni-calendar"></em>
                                                </div>
                                                <input type="text" class="form-control date-picker" placeholder="To Date" data-date-format="yyyy-mm-dd"  id="toDate" name="toDate">
                                            </div>
                                            <!-- <div class="form-note mt-0">To Date</div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="userId" name="user_id" value="0">
                    <div class="modal-footer bg-light">
                        <div class="row">
                            <div class="col-lg-12 p-0 text-right">
                                <button class="btn btn-outline-light" data-dismiss="modal" aria-label="Close">Cancel</button>
                                <button class="btn btn-danger resetFilter" data-dismiss="modal" aria-label="Close">Clear Filter</button>
                                <button class="btn btn-primary submitBtn" type="button">Submit</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
       
@endsection
@push('footerScripts')
<script src="{{url('js/tableFlow.js')}}"></script>
<script type="text/javascript">

    $(function() {

        

        var root_url = "<?php echo url('/'); ?>";

        var logUrl = root_url + '/user/logs';
        NioApp.getAuditLogs('.broadcast-init','.audit_logs','resourceid',logUrl,'#modalLogs');

        var items = [
            '#firstName',
            '#contact_number',
            '#fromDate',
            '#toDate'
        ];
        var user_table = "";
        user_table = new CustomDataTable({
            tableElem: '.broadcast-init',
            option: {
                processing: true,
                serverSide: true,
                ajax: {
                    type:"GET",
                    url: "{{ url('admin/contacts') }}",
                },
                columns: [{
                        "class": "nk-tb-col tb-col-lg nk-tb-col-check",
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return '<td class="nk-tb-col nk-tb-col-check"><div class="custom-control custom-control-sm custom-checkbox notext"><input type="checkbox" class="custom-control-input cb-check" id="cb-' + row.id + '" value="' + row.id + '" name="checked_items[]"><label class="custom-control-label" for="cb-' + row.id + '"></label></div></td>'
                        }
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'name',
                        name: 'name'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'email',
                        name: 'email'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'mobile',
                        name: 'phone_number'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg text-center",
                        data: 'message',
                        name: 'message'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg text-right",
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                "fnDrawCallback":function(){
                    NioApp.BS.tooltip('[data-toggle="tooltip"]'); 
                    $('.changePassword').click(function(){
                        var resourceId = $(this).attr('data-resourceid');
                        $('#password_user_id').val(resourceId);
                        $('#modalUserPassword').modal('show');
                    });
                }
            },
            filterSubmit: '.submitBtn',
            filterSubmitCallback: function(){
                $('#modalFilterUser').modal('toggle');
            },
            filterClearSubmit: '.resetFilter',
            filterModalId: '#modalFilterUser',
            filterItems: items,
            tagId: '#filter_tag_list',
        });

        $('.broadcast-init').on("change","#check-all",function() {
            // If checked
            if (this.checked)
                $('.cb-check').prop('checked', true);
            else
                $('.cb-check').prop('checked', false);
        });

    });
</script>
@endpush