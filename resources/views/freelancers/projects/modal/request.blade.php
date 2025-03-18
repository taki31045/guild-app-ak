<div class="modal fade" id="requestModal" tabindex="-1" aria-labelledby="requestModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Do you want to request this project?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to request to join this project?</p>
                <a href="{{route('freelancer.projects.request', $project->id)}}" class="btn btn-primary mt-4 w-100">Request</a>
            </div>
        </div>
    </div>
</div>
