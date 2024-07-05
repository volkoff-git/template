<table class="table table-responsive">
    <thead class="sticky-top">
    <tr>
        <th>#</th>
        <th class="text-nowrap">Heading 1</th>


    </tr>
    </thead >
    <tbody>
    <tr onclick="Lead.table_click_handler(1)">
        <th>1</th>
        <td><a href="#" </td>
    </tr>
    <tr  onclick="Lead.table_click_handler(2)">
        <th>2</th>
        <td></td>
    </tr>
    <tr  onclick="Lead.table_click_handler(3)">
        <th>3</th>
        <td></td>
    </tr>
    <tr  onclick="Lead.table_click_handler(4)">
        <th>4</th>
        <td></td>
    </tr>
    </tbody>
</table>


<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" id="leadModalTrigger" data-bs-target="#leadModal"></button>


<div class="modal" id="leadModal" tabindex="-1">
    <div class="modal-dialog modal-full-width modal-dialog-centered" role="document">
        <div class="modal-content" id="mainModal_content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" id="closeLeadModal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>