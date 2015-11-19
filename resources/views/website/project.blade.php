<a href="javascript:$.pageslide.close();" class="closeProject" title="Close">X</a>
<h1>{{ $project->title }}</h1>
<div class="col-lg-6 col-md-6 col-sm-8 col-xs-8 remove-padding-l margin-bottom-10 margin-top-20">{{ $project->type->projectsTypeName }}</div>
<div class="col-lg-6 col-md-6 col-sm-4 col-xs-4 remove-padding-r margin-bottom-10 margin-top-20">{{ $project->projectDate->format('M/Y') }}</div>

<div class="col-xs-6 remove-padding-l margin-bottom-20">Client: {{ $project->client }}</div>
@if(!empty($project->agency))
<div class="col-xs-6 remove-padding-r margin-bottom-20">Agency: {{ $project->agency }}</div>
@endif

@if(!empty($project->url))
<div class="col-xs-12 margin-bottom-20 url"><a href="http://{{ $project->url }}" target="_blank" title="Visit">{{ $project->url }}</a></div>
@endif

<div class="col-xs-12 remove-padding margin-top-20">
    {!! $project->description !!}
</div>

@if(count($project->movie) > 0)
<div class="col-xs-12 remove-padding margin-top-20">
    @foreach($project->movie as $movie)
    <p>{{ $movie->label }}</p>
    <iframe width="100%" height="400" class="projectMovie" src="{!! $movie->embed !!}" frameborder="0"></iframe>
    <br /><br />
    @endforeach
</div>
@endif

@if(count($project->gallery) > 0)
<div class="col-xs-12 remove-padding margin-top-20">
    @foreach($project->gallery as $gallery)
    <p>{{ $gallery->label }}</p>
    <img src="{{ asset('assets/images/_upload/projects/'.$project->projectsId.'/'.$gallery->image) }}" class="img-responsive" alt="@if(!empty($gallery->label)) {{ $gallery->label }} @else {{ $project->title }} @endif" />
    <br /><br />
    @endforeach
</div>
@endif

<div class="col-xs-12 remove-padding margin-top-20 margin-bottom-20">
    Tags: <em>{{ $project->tags }}</em>
</div>