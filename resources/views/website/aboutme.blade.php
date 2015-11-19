<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
    <div class="aboutMePicture pull-right">
        <img src="{{ asset('assets/images/_upload/websiteSettings/'.$websiteSettings['avatar']) }}" alt="Bruno's Picture" />
    </div>
    @foreach($aboutMe as $text)
    <h4 class="modal-title font-size-28 green strong text-uppercase">{{ $text->title }}</h4>
    <p class="font-size-16">{{ $text->text }}</p>
    <br /><br />
    @endforeach
    <h4 class="modal-title font-size-28 green strong text-uppercase">Experience</h4>
    <ul class="experience font-size-16">
        @foreach($experiences as $experience)
        <li>
            @if(empty($experience->dateEnd))
                {{ 'Since ' }}
            @endif
            {{ $experience->dateStart->format('M/Y') }}
            @if(!empty($experience->dateEnd))
                {{ " - ".$experience->dateEnd->format('M/Y') }}
            @endif
            {{ " | ".$experience->position }}, {{ $experience->company }}
            {!! $experience->description !!}
        </li>
        @endforeach
    </ul>

    <br /><br />

    <h4 class="modal-title font-size-28 green strong text-uppercase">Skills</h4>
    <div class="row skills">
        @foreach($skills as $skill)
        <p class="col-lg-3 col-md-3 col-sm-6 col-xs-6 font-size-16">{{ $skill->name }} @if(!empty($skill->comment)){!! "<em>".$skill->comment."</em>" !!}@endif</p>
        @endforeach
    </div>

    <br /><br />

    <h4 class="modal-title font-size-28 green strong text-uppercase">Languages</h4>
    <div class="row">
        <div class="col-xs-12 language">
            <div class="languages">
                <header>
                    <dd>
                        <span class="hidden-xs">Language</span>
                        <span class="show-xs hidden-sm hidden-md hidden-lg">L</span>
                    </dd>
                </header>
                @foreach($languages as $language)
                <dd><img src="{{ asset('assets/images/_upload/languages/'.$language->flag) }}" alt="{{ $language->languageName }}" /> <span class="hidden-xs">{{ $language->languageName }}</span></dd>
                @endforeach
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Write</th>
                            <th>Read</th>
                            <th>Speak</th>
                            <th>Listen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($languages as $language)
                        <tr>
                            <td>{{ $language->writeName->languageLevelsName }}</td>
                            <td>{{ $language->readName->languageLevelsName }}</td>
                            <td>{{ $language->speakName->languageLevelsName }}</td>
                            <td>{{ $language->listenName->languageLevelsName }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br />
</div>