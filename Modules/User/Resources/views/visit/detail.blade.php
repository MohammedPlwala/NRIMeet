@extends('admin.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title"><a href="javascript:history.back()" class="pt-3"><em
                            class="icon ni ni-chevron-left back-icon"></em> </a> Visiter / <strong
                        class="text-primary small">{{ $visiter->name }}</strong></h3>
            </div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card">
            <div class="card-aside-wrap">
                <div class="card-content">
                    <div class="card-inner">
                        <div class="nk-block">
                            <div class="nk-block">
                                <div class="nk-data data-list">
                                    <div class="data-head">
                                        <h6 class="overline-title">Visiter Information</h6>
                                    </div>
                                    <div class="data-item" data-target="#profile-edit">
                                        <div class="data-col">
                                            <span class="data-label">Full Name</span>
                                            <span class="data-value">{{ $visiter->name }} </span>
                                        </div>
                                        <!-- <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div> -->
                                    </div><!-- data-item -->
                                    <div class="data-item">
                                        <div class="data-col">
                                            <span class="data-label">Email Id</span>
                                            <span class="data-value">{{ $visiter->email }}</span>
                                        </div>
                                        <!-- <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div> -->
                                    </div><!-- data-item -->
                                    <div class="data-item" data-target="#profile-edit">
                                        <div class="data-col">
                                            <span class="data-label">Phone/Mobile No</span>
                                            <span class="data-value">{{ $visiter->mobile }}</span>
                                        </div>
                                        <!-- <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div> -->
                                    </div><!-- data-item -->
                                    <div class="data-item" data-target="#profile-edit">
                                        <div class="data-col">
                                            <span class="data-label">PBD Registration No</span>
                                            <span class="data-value">{{ $visiter->registration_number }} </span>
                                        </div>
                                        <!-- <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div> -->
                                    </div><!-- data-item -->
                                    <div class="data-item" data-target="#profile-edit">
                                        <div class="data-col">
                                            <span class="data-label">Country of Residence</span>
                                            <span class="data-value">{{ $visiter->country }} </span>
                                        </div>
                                        <!-- <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div> -->
                                    </div><!-- data-item -->
                                    <div class="data-item" data-target="#profile-edit">
                                        <div class="data-col">
                                            <span class="data-label">Country Code</span>
                                            <span class="data-value">{{ $visiter->country_code }} </span>
                                        </div>
                                        <!-- <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div> -->
                                    </div><!-- data-item -->
                                    <div class="data-item" data-target="#profile-edit">
                                        <div class="data-col">
                                            <span class="data-label">Total Number of Members</span>
                                            <span class="data-value">{{ $visiter->members }} </span>
                                        </div>
                                        <!-- <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div> -->
                                    </div><!-- data-item -->
                                    <div class="data-item" data-target="#profile-edit">
                                        <div class="data-col">
                                            <span class="data-label">Departure From Indore</span>
                                            <span class="data-value">{{ $visiter->departure_indore }} </span>
                                        </div>
                                        <!-- <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div> -->
                                    </div><!-- data-item -->
                                    <div class="data-item" data-target="#profile-edit">
                                        <div class="data-col">
                                            <span class="data-label">Departure From Ujjain</span>
                                            <span class="data-value">{{ $visiter->departure_ujjain }} </span>
                                        </div>
                                        <!-- <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div> -->
                                    </div><!-- data-item -->
                                    @if ($visiter->file)
                                        <div class="data-item" data-target="#profile-edit">
                                            <div class="data-col">
                                                <span class="data-label">Upload member's deatils</span>
                                                <span class="data-value">
                                                    <a target="_blank" href="{{ URL::to('/uploads/mahakalLokDarshan/' . $visiter->file) }}">
                                                        {{ URL::to('/uploads/mahakalLokDarshan/' . $visiter->file) }}
                                                    </a>
                                                </span>
                                            </div>
                                            <!-- <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div> -->
                                        </div><!-- data-item -->
                                    @endif

                                </div><!-- data-list -->
                            </div>

                        </div><!-- .nk-block -->
                    </div><!-- .card-inner -->
                </div><!-- .card-content -->

            </div><!-- .card-aside-wrap -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
@endsection
