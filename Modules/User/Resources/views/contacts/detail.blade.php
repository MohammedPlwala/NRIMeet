@extends('admin.layouts.app')

@section('content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between g-3">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title"><a href="javascript:history.back()" class="pt-3"><em class="icon ni ni-chevron-left back-icon"></em> </a>  Contact / <strong class="text-primary small">{{ $contacts->name }}</strong></h3>
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
                                    <h6 class="overline-title">Contact Information</h6>
                                </div>
                                <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                    <div class="data-col">
                                        <span class="data-label">Name</span>
                                        <span class="data-value">{{ $contacts->name }} </span>
                                    </div>
                                    <!-- <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div> -->
                                </div><!-- data-item -->
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="data-label">Email Id</span>
                                        <span class="data-value">{{ $contacts->email }}</span>
                                    </div>
                                    <!-- <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div> -->
                                </div><!-- data-item -->
                                <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                    <div class="data-col">
                                        <span class="data-label">Mobile</span>
                                        <span class="data-value">{{ $contacts->mobile }}</span>
                                    </div>
                                    <!-- <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div> -->
                                </div><!-- data-item -->
                                <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                    <div class="data-col">
                                        <span class="data-label">Message</span>
                                        <span class="data-value">{{ $contacts->message }} </span>
                                    </div>
                                    <!-- <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div> -->
                                </div><!-- data-item -->
                            </div><!-- data-list -->
                        </div>
                        
                    </div><!-- .nk-block -->
                </div><!-- .card-inner -->
            </div><!-- .card-content -->
            
        </div><!-- .card-aside-wrap -->
    </div><!-- .card -->
</div><!-- .nk-block -->
@endsection