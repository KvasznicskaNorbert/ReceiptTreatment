   <!-- Password Change -->
    <!-- The Modal -->
    <div class="modal" id="changepass">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Change Password</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" >
                    <div class="form-floating mb-3">
                        <input type="password" id="thepass" name="thepass" class="form-control form-control-lg" required placeholder="Jelenlegi Jelszó" />
                        <label class="form-label" for="thepass">Jelenlegi Jelszó</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" id="newpass" name="newpass" class="form-control form-control-lg" required placeholder="Új Jelszó" />
                        <label class="form-label" for="newpass">Új Jelszó</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" id="newpass2" name="newpass2" class="form-control form-control-lg" required placeholder="Új Jelszó Megerősítése" />
                        <label class="form-label" for="newpass2">Új Jelszó megerősítése</label>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2" id="newpassok" name="newpassok">Change</button>

                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

            </div>
        </div>