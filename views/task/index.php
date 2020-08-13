<?php

use yii\helpers\Html;

?>

<!-- Button til ny oppgaveliste -->
<div class="d-flex justify-content-center">
    <button type="button"
            class="btn btn-secondary btn-lg"
            data-toggle="modal"
            data-target="#newTasklist">Ny oppgaveliste +
    </button>
</div>

<div class="site-index col">

    <?php foreach ($tasklists as $list): ?>
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 p-3">
            <div class="card bg-light">
                <div class="card-header d-flex justify-content-between">
                    <div class="align-items-start">
                        <strong>
                            <h2 class="m-0">
                                <?= Html::encode($list->title) ?>
                            </h2>
                        </strong>
                    </div>
                    <div class="align-self-center">

                        <!-- Legge til oppgave -->
                        <button type="button"
                                class="btn btn-secondary add"
                                data-toggle="modal"
                                data-target="#addTask"
                                data-add="<?= $list->ID ?>"
                                onclick="getIDAdd(<?= $list->ID ?>)">+
                        </button>

                        <!-- Slette oppgaveliste -->
                        <button type="button"
                                class="btn btn-danger deleteTasklist"
                                data-deletetasklist="<?= $list->ID ?>"
                                onclick="deleteTasklist(<?= $list->ID ?>)">
                            <i class="far fa-trash-alt"></i>
                        </button>

                    </div>
                </div>
                
                <div class="card-body">
                    <ul class="list-unstyled">
                        <!-- getTasks() finnes i models/Tasklist.php -->
                        <?php $tasks = $list->getTasks();
                        foreach ($tasks as $task): ?>
                            <li class="mb-1">

                                <p class="beskrivelse p-0 m-0">
                                    <?= Html::encode($task->description) ?>
                                </p>

                                <!-- Flytt -->
                                <button type="button"
                                        class="btn btn-success move"
                                        data-move="<?= $task->ID ?>"
                                        data-toggle="modal"
                                        data-target="#moveTask"
                                        onclick="getIDMove(<?= $task->ID ?>)">
                                    <i class="fas fa-arrows-alt-h"></i>
                                </button>

                                <!-- Endre -->
                                <button type="button"
                                        class="btn btn-warning edit"
                                        data-toggle="modal"
                                        data-target="#endreOppgave"
                                        data-edit="<?= $task->ID ?>"
                                        data-description="<?= $task->description ?>"
                                        onclick="getIDAndDescription(<?= $task->ID ?>)">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>

                                <!-- Slett -->
                                <button type="button"
                                        class="btn btn-danger"
                                        onclick="deleteTask(<?= $task->ID ?>)">
                                    <i class="far fa-trash-alt"></i>
                                </button>

                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <h3 class="d-flex justify-content-center">Antall oppgaver:
                        <strong>
                            <?php
                            $count = count($tasks);
                            echo "&nbsp";
                            echo $count;
                            ?>
                        </strong>
                    </h3>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Modal for å endre oppgave -->
<div class="modal fade" id="endreOppgave" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="endreOppgave">Endre oppgave</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="">
                    <label for="alterDescription">Endre oppgave til:</label>
                    <input type="text" id="alterDescription">
                </form>
            </div>

            <div class="modal-footer">

                <!-- Endre -->
                <button type="button"
                        class="btn btn-primary"
                        data-toggle="modal"
                        onclick="updateTask()">Lagre endringer
                </button>

                <!-- Lukk -->
                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">Lukk
                </button>

            </div>
        </div>
    </div>
</div>

<!-- Modal for å legge til oppgave -->
<div class="modal fade" id="addTask" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Legg til oppgave</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <form class="">
                    <label for="add">Legg til oppgave:</label>
                    <input type="text" id="addNewTask">
                    <input type="text" id="addID" style="visibility: hidden;" readonly>
                </form>

            </div>

            <div class="modal-footer">

                <!-- Legge til oppgave -->
                <button class="btn btn-primary add"
                        data-toggle="modal"
                        onclick="addTask()">Legg til oppgave
                </button>

                <!-- Lukk -->
                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">Lukk
                </button>

            </div>
        </div>
    </div>
</div>

<!-- Modal for å legge til oppgaveliste -->
<div id="newTasklist" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Legg til oppgaveliste</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="">
                    <label for="add">Legg til oppgaveliste:</label>
                    <input type="text" id="addTasklist">
                </form>

            </div>

            <!-- Legge til oppgaveliste -->
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-primary"
                        onclick="addTasklist()">Legg til oppgaveliste
                </button>

                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">Lukk
                </button>

            </div>
        </div>
    </div>
</div>

<!-- Modal for å flytte oppgave -->
<div id="moveTask" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Flytt oppgave</h2>
                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- Listeboks flytt -->
                <label for="select-list">Flytt oppgave til:</label>
                <select id="select-list">
                    <?php foreach ($tasklists as $t): ?>
                        <option id="moveTask" value="<?= $t->ID ?>">
                            <?= Html::encode($t->title) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

            </div>
            <div class="modal-footer">

                <!-- Flytt oppgave -->
                <button type="button"
                        class="btn btn-primary"
                        onclick="moveTask()">Flytt oppgave
                </button>

                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">Lukk
                </button>

            </div>
        </div>
    </div>
</div>

<script>

    // Legge til ny oppgaveliste
    function addTasklist() {

        let title = $('#addTasklist').val();

        if (title !== '') {
            $.ajax({
                url: '/index.php?r=task/addtasklist&title=' + title,
                datatype: 'json',
                success: function (result) {
                    console.log(result);
                    location.reload();
                }
            });
        } else {
            alert('Feltet må fylles ut.');
        }
    }

    // Slett
    function deleteTask(id) {

        let deleteTask = confirm("Er du sikker?");

        if (deleteTask) {
            $.ajax({
                url: '/index.php?r=task/delete&id=' + id, // task = TaskController | delete = actionDelete | id = parameter
                dataType: 'json',
                success: function (result) {
                    console.log(result, id);
                    location.reload();
                }
            });
            return true;
        } else {
            return false;
        }
    }

    // Slette oppgaveliste
    function deleteTasklist(id) {

        let deleteTasklist = $('button.deleteTasklist[data-deletetasklist=' + id + ']').attr('data-deletetasklist');
        console.log("ID er: " + deleteTasklist);

        let deleteSelectedTasklist = confirm("Er du sikker?");

        if (deleteSelectedTasklist) {
            $.ajax({
                url: '/index.php?r=task/deletetasklist&id=' + id,
                datatype: 'json',
                success: function (result) {
                    console.log(result);
                    location.reload();
                }
            });
            return true;
        } else {
            return false;
        }
    }

    // Henter ut og lagrer ID på valgt oppgave
    function getIDMove(id) {
        selectedTaskMove = $('button.move[data-move=' + id + ']').attr('data-move');
        console.log('ID er: ' + selectedTaskMove);
    }

    // Flytt
    let selectedTaskMove = 0;

    function moveTask(id) {
        // id: id på oppgaven som skal flyttes
        // newTasklist: id på lista som oppgaven skal flyttes til

        let newTasklist = $('#select-list').val();

        $.ajax({
            url: '/index.php?r=task/move&id=' + selectedTaskMove + '&tasklist_id=' + newTasklist,
            datatype: 'json',
            success: function () {
                console.log("ID på den nye lista er: " + newTasklist);
                location.reload();
            }
        });
    }

    // Endre
    let selectedTaskEdit = 0;

    function updateTask() {

        let alterDescription = $('#alterDescription').val();

        if (alterDescription !== '') {
            $.ajax({
                url: '/index.php?r=task/edit&id=' + selectedTaskEdit + '&description=' + alterDescription,
                datatype: 'json',
                success: function () {
                    if (alterDescription !== '') {
                        console.log('Du skrev: ' + alterDescription + '.');
                    } else {
                        console.log('Du skrev ikke inn noe...');
                    }
                    location.reload();
                }
            });
        } else {
            alert('Feltet må fylles ut.');
        }
    }

    // Legge til oppgave
    let selectedTasklist = 0;

    function addTask() {

        let add = $('#addNewTask').val();

        if (add !== '') {
            $.ajax({
                url: '/index.php?r=task/add&tasklist_ID=' + selectedTasklist + '&description=' + add,
                datatype: 'json',
                success: function () {
                    if (add !== '') {
                        console.log('Du skrev: ' + add + '.');
                    } else {
                        console.log('Du skrev ikke inn noe...');
                    }
                    location.reload();
                }
            });
        } else {
            alert('Feltet må fylles ut');
        }
    }

    // Henter ut og lagrer ID på valgt oppgave
    function getIDAndDescription(id) {
        selectedTaskEdit = $('button.edit[data-edit=' + id + ']').attr('data-edit');
        console.log('ID er: ' + selectedTaskEdit);

        let selectedDescription = $('button.edit[data-edit=' + id + ']').attr('data-description');
        console.log('Beskrivelse er : ' + selectedDescription + '.');

        $('#alterDescription').val(selectedDescription);
    }

    function getIDAdd(id) {
        selectedTasklist = $('button.add[data-add=' + id + ']').attr('data-add');
        $('#addID').val(selectedTasklist);
        console.log('ID er: ' + selectedTasklist + '.');
    }

</script>

<!--
let selectedItem = null;
$('button.edit').on('click', updateTask());

selectedItem = $(this).attr('data-foo');

const correctID = $('#correctID').val();
console.log("Selected item is: ", selectedItem);

$ids = [];
$ids[$list->ID] = []; ?>
$ids[$list->ID][] = $task->ID;

id = $($('.card-body button.edit[data-foo="' + id + '"]')).attr('data-foo');
selectedEl = $($('.card-body button.edit[data-foo="' + id + '"]')).attr('data-foo');

console.log("ID er: " + $($('.card-body button.edit[data-foo="' + id + '"]')).attr('data-foo'));

id = $($('.card-body button.edit[data-foo="' + id + '"]')).attr('data-foo');
-->
