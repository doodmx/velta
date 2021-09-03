<div class="d-flex justify-content-end mt-3">
    @if($enroll->approval_certificate === null)
        <a href="{{route('web.enrolls.quiz',$enroll->id)}}"
           class="btn btn-primary btn-rounded {{$enroll->chapter_progress < 100 ? 'd-none':''}} btn-cert">
            <i class="fas fa-file-pdf mr-2"></i>
            {{__('courses/learn.certificate')}}
        </a>
    @endif

    @if(!empty($enroll->approval_certificate))
        <a href="{{asset($enroll->approval_certificate)}}"
           download="{{clean_file_name(auth()->user()->profile->lastname.' '.auth()->user()->profile->name)}}"
           class="btn btn-primary btn-rounded">
            <i class="fas fa-download mr-2"></i>
            {{__('courses/learn.download_certificate')}}

        </a>
    @endif
</div>
