    <!-- Username Change -->
    <!-- The Modal -->
    <div class="modal" id="changeusername">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Change username</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="post" >
                        

                        <div class="form-floating mb-3">
                            <input type="text" id="newusername" name="newusername" class="form-control form-control-lg" required placeholder="Új Jelszó" />
                            <label class="form-label" for="newusername">Új Felhasználónév</label>
                        </div>

                        <button type="submit" class="btn btn-primary mt-2" id="newusernameok" name="newusernameok">Change</button>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>