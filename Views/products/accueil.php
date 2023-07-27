<!-- <?php var_dump($products) ?> -->


<div class="container border border-secondary p-5">
    <?php if (isset($categories)) : ?>
    <div class="container m-3 p-2">
        <form action="" method="GET">
            <div class="form-group">
                <label for="cat" class="form-label mt-4">Catégorie</label>
                <select class="form-select" id="cat" name="idCat">
                    <option value="">Toutes les catégories</option>
                    <?php foreach($categories as $category) : ?>
                        <option value="<?= $category['idCategory'] ?>" <?= isset($_GET['idCat']) && $_GET['idCat'] == $category['idCategory'] ? "selected" : null ?>><?= $category['title'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="text-center m-2">
                <button type="submit" class="btn btn-primary">Valider</button>
            </div>
        </form>

    </div>
    <?php endif ?>
    
    <div class="row justify-content-around">
        <?php foreach ($products as $product) : ?>
            <div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
                <div class="card-header">Catégorie : <?= $product['catTitle'] ?></div>
                <div class="card-body">
                    <h4 class="card-title"><?= $product['productTitle'] ?></h4>
                    <img src="image/<?= $product['image'] ?>" alt="<?= $product['productTitle'] ?>" class="img-fluid">
                    <p class="card-text"><?= $product['description'] ?></p>
                    <p><span class="text-black"> <?= $product['price'] ?> €</span></p>
                </div>
                <div class="card-footer text-center">
                    <a href="/detailProduct?id=<?= $product['idProduct'] ?>" class="btn btn-secondary">Détail</a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>