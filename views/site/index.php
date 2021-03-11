<div class="row">
    <div class="shadow-sm p-3 mb-5 bg-body rounded">
        <div class="custom-row">
            <span class="h2">Расписание</span>
            <button class="btn btn-primary" type="button">Добавить</button>
        </div>
        <hr>
        <?php if ($model) : ?>
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Регионы</th>
                        <th scope="col"><a href="#" class="departure" data-sort="1">Дата отправления</a></th>
                        <th scope="col">ФИО курьера </th>
                        <th scope="col"><a href="#" class="arrival" data-sort="1">Дата прибытия</a></th>
                    </tr>
                </thead>
                <tbody id="tableTravel">
                    <?php foreach ($model as $key => $value) : ?>
                        <tr class="item">
                            <th scope="row"><?= $key + 1 ?></th>
                            <td><?= $value['region'] ?></td>
                            <td data-departure="<?= $value['departure_date'] ?>"><?= date('d.m.Y', $value['departure_date']) ?></td>
                            <td><?= $value['courier_name'] ?></td>
                            <td data-arrival="<?= $value['arrival_date'] ?>"><?= date('d.m.Y', $value['arrival_date']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p class="text-center">Список пуст.</p>
        <?php endif; ?>
    </div>

</div>