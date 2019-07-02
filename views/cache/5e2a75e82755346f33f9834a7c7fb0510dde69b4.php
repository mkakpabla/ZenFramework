<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Ajouter des livres</h1>
                <form action="">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="title">Titre du livre</label>
                                <input id="title" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="slug">Slug du livre</label>
                                <input id="slug" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="author">Auteur du livre</label>
                                <input id="author" class="form-control" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="resume">Résumé du livre</label>
                                <textarea class="form-control" name="resume" id="resume" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary">Sauvegarder</button>
                </form>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Workspace\ZenFramework\views/books/create.blade.php ENDPATH**/ ?>