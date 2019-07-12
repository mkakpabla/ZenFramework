<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Liste des livres</h1>
            </div>
        </div>
        <a href="/books/create" class="btn btn-success mb-1">Ajouter un nouveau livre</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($book->title); ?></td>
                        <td><?php echo e($book->author); ?></td>
                        <td>
                            <a href="" class="btn btn-primary">Voir</a>
                            <a href="" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Workspace\ZenFramework\app\Views/books/index.blade.php ENDPATH**/ ?>