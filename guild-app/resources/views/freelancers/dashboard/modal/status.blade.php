<div class="modal fade" id="projectStatusModal-{{$application->id}}" tabindex="-1" aria-labelledby="projectStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="projectStatusModalLabel-{{$application->id}}">
                    @if ($application->status === 'requested')
                        Do you want to cancel your request?
                    @elseif($application->status === 'accepted')
                        Do you want to start working on this project?
                    @elseif($application->status === 'rejected')
                        Your request was rejected by the company.
                    @elseif($application->status === 'ongoing')
                        Do you want to submit your work?
                    @elseif($application->status === 'resulted')
                        Do you want to receive your payment?
                    @else
                        Project Status
                    @endif
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                @if ($application->status === 'requested')
                    If you cancel this project request, it cannot be undone.
                    <a href="{{route('freelancer.projects.cancel', $application->id)}}" class="btn btn-danger mt-4 w-100">Cancel Request</a>
                @elseif($application->status === 'accepted')
                    Once you start this project, the status will be change to "ongoing".
                    <a href="{{route('freelancer.projects.start', $application->id)}}" class="btn btn-primary mt-4 w-100">Start</a>
                @elseif($application->status === 'rejected')
                    This project request has been rejected.
                    <a href="{{route('freelancer.projects.acknowledge', $application->id)}}" class="btn btn-primary mt-4 w-100">Acknowledge</a>
                @elseif($application->status === 'ongoing')
                    <p>Once you submit your work, it will be reviewed.</p>

                    <!-- エラー表示エリア -->
                    <div id="error-messages-{{$application->id}}" class="alert alert-danger d-none"></div>

                    <form id="submitForm-{{$application->id}}" action="{{route('freelancer.projects.submit', $application->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="file-upload-{{$application->id}}" class="form-label">Upload your work file</label>
                        <input type="file" class="form-control" id="file-upload-{{$application->id}}" name="submission_file" required>
                        <button type="submit" class="btn btn-primary mt-4 w-100">Submit Work</button>
                    </form>

                @elseif($application->status === 'resulted')
                    @if ($application->project->evaluation !== NULL)
                        <div class="evaluation-container">
                            <h4>Evaluation</h4>
                            <div class="evaluation-item">
                                <span class="evaluation-title">Quality</span>
                                <div class="evaluation-bar">
                                    <div class="progress" style="width: {{$application->project->evaluation->quality * 10}}%">{{$application->project->evaluation->quality * 10}}%</div>
                                </div>
                            </div>
                            <div class="evaluation-item">
                                <span class="evaluation-title">Communication</span>
                                <div class="evaluation-bar">
                                    <div class="progress" style="width: {{$application->project->evaluation->communication * 10}}%">{{$application->project->evaluation->communication * 10}}%</div>
                                </div>
                            </div>
                            <div class="evaluation-item">
                                <span class="evaluation-title">Adherence</span>
                                <div class="evaluation-bar">
                                    <div class="progress" style="width: {{$application->project->evaluation->adherence * 10}}%">{{$application->project->evaluation->adherence * 10}}%</div>
                                </div>
                            </div>
                            <div class="evaluation-item">
                                <span class="evaluation-title">Total</span>
                                <div class="evaluation-bar">
                                    <div class="progress" style="width: {{$application->project->evaluation->total * 10}}%">{{$application->project->evaluation->total * 10}}%</div>
                                </div>
                            </div>
                        </div>
                    @endif
                    If you receive your payment, the project status will be changed to "completed."
                    <a href="{{route('freelancer.projects.result', $application->id)}}" class="btn btn-primary mt-4 w-100">result</a>
                @else
                    Current project Status: {{ucfirst($application->status)}}
                @endif
            </div>
        </div>
    </div>
</div>
