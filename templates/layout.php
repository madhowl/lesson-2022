
    <div class="row my-2">
        <div class="col">
            <?= showForm('add.php','Add new work' )?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card mt-4">
                <div class="card-body">
                    <h4 class="card-title">Work List</h4>
                    <p class="card-text">Список важных дел</p>
                </div>
                <ul class="list-group list-group-flush">


                    <?= showWorkList() ?>


                </ul>
            </div>
        </div>
    </div>



