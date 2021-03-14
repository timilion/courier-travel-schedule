<?php
$this->title = 'Добавить';

?>
<div class="row">
    <div class="shadow-sm p-3 mb-5 bg-body rounded">
        <div class="custom-row">
            <span class="h2"><?= $this->title ?></span>
            <a class="btn btn-primary" href="/">Расписание</a>
        </div>
        <hr>
        <div class="row">
            <form>

                <?php if ($regions) : ?>

                    <div class="mb-3">
                        <label for="region" class="form-label">Регион</label>
                        <select id="region" name="region" class="form-select">
                            <option value="">Выбрать регион</option>
                            <?php foreach ($regions as $region) : ?>
                                <option value="<?= $region['duration'] ?>">
                                    <?= $region['city'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                <?php endif; ?>


                <?php if ($couriers) : ?>

                    <div class="mb-3">
                        <label for="courier" class="form-label">Курьер</label>
                        <select id="courier" name="courier" class="form-select">
                            <option value="">Выбрать курьера</option>
                            <?php foreach ($couriers as $courier) : ?>
                                <option value="<?= $courier['id'] ?>">
                                    <?= $courier['full_name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                <?php endif; ?>
                <div class="mb-3">
                    <label for="date-departure" class="col-2 col-form-label"> Дата отправления</label>
                    <input class="form-control" name="date_departure" type="date" id="date-departure">
                </div>

                <div class="mb-3">
                    <label for="date-arrival" class="col-2 col-form-label"> Дата прибытия</label>
                    <input class="form-control" id="date-arrival" name="date_arrival" type="text" readonly>

                </div>
                <div class="invalid"></div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>

    </div>

</div>