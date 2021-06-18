<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-header">Reset Password</div>
                <div class="card-body">
                    <form autocomplete="off" @submit.prevent="requestResetPassword" method="post">
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" class="form-control" placeholder="user@example.com"
                                v-model="email" required />
                            <div class="alert alert-danger" role="alert" v-if="error">
                                {{ error }}
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">
                            Kirim Email Reset Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
