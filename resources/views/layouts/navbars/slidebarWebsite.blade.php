
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="#">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder='Search Keyword'
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
                                        <div class="input-group-append">
                                            <button class="btns" type="submit"><i
                                                    class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </aside>
                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Recent Post</h3>
                            @foreach ($postLast as $post)
                                <div class="media post_item">
                                    <div style="width: 35%">
                                        <a href="{{ url('/') . '/post' . $post->post_slug }}">
                                            <img src="{{ url('/') . '/storage/images/' . $post->post_thumbnail }}"
                                                alt="post" style="width: 100%;">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <a href="{{ url('/') . '/post' . $post->post_slug }}">
                                            <h3 class="string-2" style="height: 40px;">{{ $post->post_title }}</h3>
                                        </a>
                                        <p>{{timePost($post->created_at)}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </aside>
                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Most Popular</h3>
                            @foreach ($postsPopular as $post)
                                <div class="media post_item">
                                    <div style="width: 35%">
                                        <a href="{{ url('/') . '/post' . $post->post_slug }}">
                                            <img src="{{ url('/') . '/storage/images/' . $post->post_thumbnail }}"
                                                alt="post" style="width: 100%;">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <a href="{{ url('/') . '/post' . $post->post_slug }}">
                                            <h3 class="string-2" style="height: 40px;">{{ $post->post_title }}</h3>
                                        </a>
                                        <p>{{timePost($post->created_at)}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </aside>
                        <aside class="single_sidebar_widget tag_cloud_widget">
                            <h4 class="widget_title">Tag Clouds</h4>
                            <ul class="list">
                                @foreach ($allTags as $tag)
                                    <li>
                                        <a href="{{ url('/') . '/tags/' . $tag->tag_slug }}">{{ $tag->tag_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </aside>
                    </div>
                </div>
