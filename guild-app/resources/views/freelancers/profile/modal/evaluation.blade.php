<div class="modal fade" id="evaluation{{$completedProject->project->id}}" tabindex="-1" aria-labelledby="evaluationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="projectStatusModalLabel-{{$completedProject->project->id}}">
                    Evaluation
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="evaluation-item">
                    <span class="evaluation-title">Quality</span>
                    <div class="evaluation-bar">
                        <div class="progress" style="width: {{$completedProject->project->evaluation->quality * 10}}%">{{$completedProject->project->evaluation->quality * 10}}%</div>
                    </div>
                </div>
                <div class="evaluation-item">
                    <span class="evaluation-title">Communication</span>
                    <div class="evaluation-bar">
                        <div class="progress" style="width: {{$completedProject->project->evaluation->communication * 10}}%">{{$completedProject->project->evaluation->communication * 10}}%</div>
                    </div>
                </div>
                <div class="evaluation-item">
                    <span class="evaluation-title">Adherence</span>
                    <div class="evaluation-bar">
                        <div class="progress" style="width: {{$completedProject->project->evaluation->adherence * 10}}%">{{$completedProject->project->evaluation->adherence * 10}}%</div>
                    </div>
                </div>
                <div class="evaluation-item">
                    <span class="evaluation-title">Total</span>
                    <div class="evaluation-bar">
                        <div class="progress" style="width: {{$completedProject->project->evaluation->total * 10}}%">{{$completedProject->project->evaluation->total * 10}}%</div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
