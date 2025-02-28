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
                @elseif($application->status === 'accepted')
                    Once you start this project, the status will be change to "ongoing".
                @elseif($application->status === 'rejected')
                    This project request has been rejected.
                @elseif($application->status === 'ongoing')
                    Once you submit your work, it will be reviewed.
                @elseif($application->status === 'resulted')
                    @if ($application->project->evaluation !== NULL)
                        <div class="evaluation-container">
                            <h4>Evaluation</h4>
                            <div class="evaluation-item">
                                <span class="evaluation-title">Quality</span>
                                <div class="evaluation-bar">
                                    <div class="progress" style="width: {{$application->project->evaluation->quality * 20}}%">{{$application->project->evaluation->quality * 20}}%</div>
                                </div>
                            </div>
                            <div class="evaluation-item">
                                <span class="evaluation-title">Communication</span>
                                <div class="evaluation-bar">
                                    <div class="progress" style="width: {{$application->project->evaluation->communication * 20}}%">{{$application->project->evaluation->communication * 20}}%</div>
                                </div>
                            </div>
                            <div class="evaluation-item">
                                <span class="evaluation-title">Adherence</span>
                                <div class="evaluation-bar">
                                    <div class="progress" style="width: {{$application->project->evaluation->adherence * 20}}%">{{$application->project->evaluation->adherence * 20}}%</div>
                                </div>
                            </div>
                            <div class="evaluation-item">
                                <span class="evaluation-title">Total</span>
                                <div class="evaluation-bar">
                                    <div class="progress" style="width: {{$application->project->evaluation->total * 20}}%">{{$application->project->evaluation->total * 20}}%</div>
                                </div>
                            </div>
                        </div>
                    @endif
                    If you receive your payment, the project status will be changed to "completed."
                @else
                    Current project Status: {{ucfirst($application->status)}}
                @endif
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                @if ($application->status === 'requested')
                    <a href="{{route('freelancer.project.cancel-request', $application->id)}}" class="btn btn-danger">Cancel Request</a>
                @elseif($application->status === 'accepted')
                    <a href="{{route('freelancer.project.start', $application->id)}}" class="btn btn-primary">Start</a>
                @elseif($application->status === 'rejected')
                    <a href="{{route('freelancer.project.acknowledge', $application->id)}}" class="btn btn-primary">Acknowledge</a>
                @elseif($application->status === 'ongoing')
                    <a href="{{route('freelancer.project.submit', $application->id)}}" class="btn btn-primary">Submit</a>
                @elseif($application->status === 'resulted')
                    <a href="{{route('freelancer.project.result', $application->id)}}" class="btn btn-primary">result</a>
                @endif
            </div>
        </div>
    </div>
</div>
