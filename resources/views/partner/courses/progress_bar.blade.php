<div class="my-3">
    <div class="progress">
        <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated"
             role="progressbar"
             aria-valuenow="{{$enroll->chapter_progress}}"
             aria-valuemin="0"
             aria-valuemax="100"
             style="width: {{$enroll->chapter_progress}}%;">
        </div>
    </div>
    <p class="text-small text-right text-secondary-two mt-0">
        <span class="progress-percentage">{{$enroll->chapter_progress}}%</span>
    </p>
</div>
