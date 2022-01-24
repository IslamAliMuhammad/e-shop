@extends('client.layouts.app')

@section('content')

	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('client/images/bg-02.jpg') }}');">
		<h2 class="ltext-105 cl0 txt-center">
			Blog
		</h2>
	</section>

	<!-- Content page -->
	<section class="bg0 p-t-62 p-b-60">
		<div class="container">
			<div class="row">

                {{-- Blogs --}}
				<div class="mx-auto col-md-8 col-lg-9 p-b-80">
					<div class="p-r-45 p-r-0-lg">
						<!-- item blog -->
                        @foreach ($posts as $index=>$post)
                        <div class="p-b-63">
							<a href="blog-detail.html" class="hov-img0 how-pos5-parent">
								<img src="{{ asset("client/images/blog-$index.jpg") }}" alt="IMG-BLOG">

								<div class="flex-col-c-m size-123 bg9 how-pos5">
									<span class="ltext-107 cl2 txt-center">
										{{ Carbon\Carbon::parse($post['date'])->format('d') }}
									</span>

									<span class="stext-109 cl3 txt-center">
										{{ Carbon\Carbon::parse($post['date'])->format('M y') }}
									</span>
								</div>
							</a>

							<div class="p-t-32">
								<h4 class="p-b-15">
									<a href="blog-detail.html" class="ltext-108 cl2 hov-cl1 trans-04">
                                        {{ $post['title']['rendered'] }}
									</a>
								</h4>

								<p class="stext-117 cl6">
									{!! $post['excerpt']['rendered'] !!}
								</p>

								<div class="flex-w flex-sb-m p-t-18">
									<span class="flex-w flex-m stext-111 cl2 p-r-30 m-tb-10">
										<span>
											<span class="cl4">By</span> Admin
											<span class="cl12 m-l-4 m-r-6">|</span>
										</span>

										<span>
											StreetStyle, Fashion, Couple
											<span class="cl12 m-l-4 m-r-6">|</span>
										</span>

									</span>

								</div>
							</div>
						</div>
                        @endforeach

					</div>
				</div>


			</div>
		</div>
	</section>

@endsection
