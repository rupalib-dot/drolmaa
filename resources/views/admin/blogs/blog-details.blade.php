@extends('admin.layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row layout-top-spacing">
            <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                @include('admin.inc.validation_message')
                @include('admin.inc.auth_message')
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Blog Detail</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="row" style="margin-bottom:15px;">
                            <div class="col-6">
                                <h4>{{$record_data->blog_title}}</h4>
                                <h4 class="blog-date" >Date: {{date('d M, Y', strtotime($record_data->created_at))}}</h4>
                            </div>
                            <div class="col-6" style="text-align: right;">
                                <div class="share-link">
                                    <a target="_blank" class="share-btn twitter" href="http://twitter.com/share?text=$record_data->blog_title&url={{route('blogs.show',base64_encode($record_data->blog_id))}}"> <i style="font-size: 25px; margin-right: 10px;color:#1da1f2" class="fab fa-twitter"></i> </a>
                                    <a target="_blank" class="share-btn facebook" href="http://www.facebook.com/sharer.php?u={{route('blogs.show',base64_encode($record_data->blog_id))}}"> <i style="font-size: 25px;    margin-right: 10px;color:#1935fe" class="fab fa-facebook-square"></i> </a>
                                    <!-- <a target="_blank" class="share-btn reddit" href="#"> Reddit </a>
                                    <a target="_blank" class="share-btn hackernews" href="#"> Hacker News </a>  -->
                                    <a target="_blank" class="share-btn linkedin" href="https://www.linkedin.com/cws/share?url={{route('blogs.show',base64_encode($record_data->blog_id))}}&xdOrigin={{url('')}}&xd_origin_host={{url('')}}"> <i style="font-size: 25px;color:#2a0ec7; margin-right: 10px;" class="fab fa-linkedin"></i> </a>
                                </div>
                            </div>
                        </div>
                        <div class="blog-signle-img">
                            <img style="width: 100%;" src="{{asset('public/blog_image')}}/{{$record_data->blog_image}}" alt="">
                        </div>
                        <p style="margin-top: 30px;">@php echo html_entity_decode(nl2br($record_data->blog_details)) @endphp</p>

                        @if(count($record_data->comment) > 0)
                            <div class="list-of-commint">
                                <ol class="commentlist">
                                    @foreach($record_data->comment as $rec)
                                        <li id="comment-1" class="comment even thread-even depth-1">
                                            <article id="div-comment-1" class="comment-body">
                                                <footer class="comment-meta">
                                                    <div class="comment-author vcard">
                                                        <b class="fn">{{$rec->full_name}}</b> <span class="says">says:</span>
                                                    </div>
                                                    <div class="comment-metadata"><time>{{date('M d, Y', strtotime($rec->created_at))}} at {{date('H:i A', strtotime($rec->created_at))}}</time></div>
                                                </footer>
                                                <div class="comment-content">
                                                    <p>{{nl2br($rec->comment_details)}}</p>
                                                </div>
                                            </article>
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection  