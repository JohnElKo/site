<?php
session_start();
include_once("../doc/propose_fns.php");
include_once("../doc/db_fns.php");

function date_format_rus($date)
{
    if ($date != '' && $date != '0000-00-00') {
        return date('d.m.Y', strtotime($date));
    } else {
        return "";
    }
}

// получаем id пользователя по имени
$usr_id = get_user_id();

// Перменная для передачи параметра в ajax
$row_str_for_finan_select = '';
$row_str_for_type_works_select = '';

//require_once("../connect.php");

$linki = mysqli_connect("localhost", "bill", "modtarvin", "billing_test") or die(mysqli_error($linki)); // подключение к бд

if (isset($_POST['editTable0'])) {
    table0();
} elseif (isset($_POST['editTable1'])) {
    table1($linki, $usr_id);
} elseif (isset($_POST['editTable2'])) {
    table2($linki, $usr_id);
} elseif (isset($_POST['editTable3'])) {
    table3($linki, $usr_id);
} elseif (isset($_POST['editTable4'])) {
    table4($linki, $usr_id);
} elseif (isset($_POST['editTable5'])) {
    table5($linki, $usr_id);
} elseif (isset($_POST['editTable6'])) {
    table6($linki, $usr_id);
} elseif (isset($_POST['editTable7'])) {
    table7($linki, $usr_id);
} elseif (isset($_POST['editTable8'])) {
    table8($linki, $usr_id);
}

function table0()
{
    $header = "Общая информация об Институте";
    include_once("../doc/header2.php");
    if (!valid_user()) {
        include_once($_SERVER['DOCUMENT_ROOT'] . "/information_system/authorize.php");
        exit;
    }
    ?>
    <!--suppress ALL -->
    <div class="info_container">
        <input type="button" onclick="history.back();" value="Назад" class="btn btn-warning">
        <form action="/information_system/update_edit.php" method="post" enctype="multipart/form-data" name="firstTable">
            <input type="hidden" name="table0">
            <table class="table-info table-edit" name="tabletable">
                <?php
                mysql_select_db('billing_test');
                $result = mysql_query("SELECT * FROM general_info") or die (mysql_error()); // сохроняем результат запроса
                while ($row = mysql_fetch_assoc($result)) {
                    echo("
                    <tr>
                        <td>Полное наименование организации (в соответствии с учредительными документами)</td>
                        <td>
                            <textarea class='form-control' name='full_organization_name'>{$row['full_organization_name']}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Сокращенное наименование</td>
                        <td>
                            <textarea class='form-control' name='short_name'>{$row['short_name']}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Наименование организации на английском языке</td>
                        <td>
                            <textarea class='form-control' name='en_name'>{$row['en_name']}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Предыдущие полные и сокращенные наименования участника закупки с указанием даты переименования и подтверждением правопреемственности</td>
                        <td>
                            <textarea class='form-control' name='full_info'>{$row['full_info']}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2' class='table-head table-head-blue'><strong>Юридический адрес:</strong></td>
                    </tr>
                    <tr>
                        <td>Регион</td>
                        <td>
                            <textarea class='form-control' name='la_region'>{$row['la_region']}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Название населенного пункта</td>
                        <td>
                            <textarea class='form-control' name='la_city'>{$row['la_city']}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Название улицы</td>
                        <td>
                            <textarea class='form-control' name='la_street'>{$row['la_street']}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Номер дома</td>
                        <td>
                            <textarea class='form-control' name='la_home_num'>{$row['la_home_num']}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2' class='table-head'><strong>Почтовый адрес:</strong></td>
                    </tr>
                    <tr>
                        <td>Регион</td>
                        <td>
                            <textarea class='form-control' name='pa_region'>{$row['pa_region']}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Название населенного пункта</td>
                        <td>
                            <textarea class='form-control' name='pa_city'>{$row['pa_city']}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Название улицы</td>
                        <td>
                            <textarea class='form-control' name='pa_street'>{$row['pa_street']}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Номер дома</td>
                        <td>
                            <textarea class='form-control' name='pa_home_num'>{$row['pa_home_num']}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2' class='table-head'><strong>Регистрационные данные:</strong></td>
                    </tr>
                    <tr>
                        <td>Дата, место и орган регистрации(на основании Свидетельства о государственной регистрации)</td>
                        <td>
                            <textarea class='form-control' name='date_and_registr'>{$row['date_and_registr']}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Срок деятельности участника закупки (с учетом правопреемственности)</td>
                        <td>
                            <textarea class='form-control' name='period_activity'>{$row['period_activity']}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Размер уставного капитала</td>
                        <td>
                            <textarea class='form-control' name='size_capital'>{$row['size_capital']}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Номер и почтовый адрес Инспекции Федеральной налоговой службы, в которой участник закупки зарегистрирован в качестве налогоплательщика</td>
                        <td>
                            <textarea class='form-control' name='post_index'>{$row['post_index']}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>ИНН</td>
                        <td>
                            <textarea class='form-control' name='INN'>{$row['INN']}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>КПП</td>
                        <td>
                            <textarea class='form-control' name='KPP'>{$row['KPP']}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>ОГРН</td>
                        <td>
                            <textarea class='form-control' name='OGRN'>{$row['OGRN']}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>ОКПО</td>
                        <td>
                            <textarea class='form-control' name='OKPO'>{$row['OKPO']}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>ОКОПФ</td>
                        <td>
                            <textarea class='form-control' name='OKOPF'>{$row['OKOPF']}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>ОКФС</td>
                        <td>
                            <textarea class='form-control' name='OKFS'>{$row['OKFS']}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2' class='table-head'><strong>Банковские реквизиты:</strong></td>
                    </tr>
                    <tr>
                        <td>Наименование обслуживающего банка</td>
                        <td>
                            <textarea class='form-control' name='bank'>{$row['bank']}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='3' class='table-head'>
                            <input type='submit' value='Сохранить' name='save' class='btn btn-download'>
                        </td>
                    </tr>
                    ");
                    $last_edit = $row['last_edit'];
                }
                ?>
            </table>
        </form>
    </div>
    <?
    echo("<small>Последнее изменение : " . $last_edit . "</small>");
}

function table1($linki, $usr_id)
{
    $header = "Сведения о работах ФГБНУ НИИ РИНКЦЭ";
    include_once("../doc/header2.php");
    if (!valid_user()) {
        include_once($_SERVER['DOCUMENT_ROOT'] . "/information_system/authorize.php");
        exit;
    }
    ?>
    <script type="text/javascript" src="/js/jquery.MultiFile.for_1_table_new.js"></script>
    <div class="info_container">
        <input type="button" onclick="history.back();" value="Назад" class="btn btn-warning">
        <!--<form action="test.php" method="post" enctype="multipart/form-data" name="firstTable">-->
        <form action="update_edit.php" method="post" enctype="multipart/form-data" name="firstTable">
            <input type="hidden" name="table1">
            <table class="table-info table-edit">
                <?php
                //mysqli_select_db($link, "billing_test");
                $id = $_POST['id'];
                $query = "SELECT * FROM work_performed WHERE id=" . $id; // запрос выборки таблицы
                $result = mysqli_query($linki, $query) or die (mysqli_error($linki)); // сохроняем результат запроса
                while ($row = mysqli_fetch_assoc($result)) {
                    echo("<tr>
                    <td colspan='3' class='table-head'>
                        <input type='hidden' value='{$id}' name='id'>
                        <input type='submit' value='Сохранить изменения' name='save' class='btn btn-download'>
                    </td>
                    </tr>");
                    echo("<tr><td colspan='2'>Наименование работы</td><td style='width: 500px;' ><textarea class='form-control' name='nameJob'>{$row['nameJob']}</textarea></td></tr>");
                    // авторы
                    echo("<tr>
                            <td rowspan='2'>Период выполнения работ</td>
                            <td>Начало</td>
                            <td>
                                <div class='input-group'>
                                    <span class='input-group-addon'>Дата</span>
                                    <input type='text' class='datepicker form-control' name='beginJob' value='" . date_format_rus($row['beginJob']) . "'>
                                </div>
                            </td>
                          </tr>");
                    echo("<tr>
                              <td>Окончание</td>
                              <td>
                                <div class='input-group'>
                                    <span class='input-group-addon'>Дата</span>
                                    <input type='text' class='datepicker form-control' name='endJob' value='" . date_format_rus($row['endJob']) . "'>
                                </div>
                              </td>
                    </tr>");
                    echo("<tr><td colspan='2'>Исполнитель и его роль</td><td>");
                    edit_implementers($linki, $row['authors']);
                    // Ввод стороннего автора
                    ?>
                    <!-- Если нужны сторонние исполнители -->
                    <div class="external-authors-block">
                        <div class="checkbox">
                            <label><input type="checkbox" onclick="showHide1Table(this, '.external-authors-wrapper')">Исполнителя
                                нет в списке</label>
                        </div>
                        <div class="external-authors-wrapper item-with-padding">
                            <input type="button" class="btn btn-download" value="Добавить исполнителя"
                                   onclick="cloneImplementer();">
                            <div class="external-authors">
                                <div class="item-with-padding">
                                    <input type="text" name="name-external[]" class="name-author form-control"
                                           placeholder="Имя исполнителя">
                                </div>
                                <div class="item-with-padding">
                                    <select name="role-external[]" class="role-author chosen-select-simple">
                                        <option>Научный руководитель</option>
                                        <option>Ответственный исполнитель</option>
                                        <option>Исполнитель</option>
                                    </select>
                                </div>
                                <div class="item-with-padding">
                                    <input type="text" name="part-external[]" class="part-author form-control"
                                           placeholder="Доля участия">
                                </div>
                                <input type="button" class="btn btn-download" value="Удалить"
                                       onclick="delImplementer(this.parentNode);">
                                <hr>
                            </div>
                        </div>
                    </div>
                    <?
                    echo("</tr>");
                    echo("<tr><td colspan='2'>Тип работы</td><td>");
                    /*$types = array("Гос задание", "Контракт", "Экспертное заключение");
                    editsOptions($types, $row['type_work']);*/
                    edit_type_works($row['type_work']);
                    echo("<tr><td rowspan='4'>Заказчик</td><td>Наименование</td><td><textarea class='form-control' name='nameCustomer'>{$row['nameCustomer']}</textarea></td></tr>");
                    echo("<tr><td>Адрес</td><td><textarea class='form-control' name='adresCostomer'>{$row['adresCostomer']}</textarea></td></tr>");
                    echo("<tr><td>Телефон</td><td><textarea class='form-control' name='telCostomer'>{$row['telCostomer']}</textarea></td></tr>");
                    echo("<tr><td>Контактное лицо</td><td><textarea class='form-control' name='personCostomen'>{$row['personCostomen']}</textarea></td></tr>");
                    echo("<tr><td rowspan='4'>Реквизиты договора (задания)</td>
                              <td>Номер контракта (номер темы в рамках госзадания)</td>
                              <td><textarea class='form-control' name='contract_number'>{$row['contract_number']}</textarea></td>
                          </tr>
                          <tr>
                              <td>Дата контракта</td>
                              <td>
                                <div class='input-group'>
                                    <span class='input-group-addon'>Дата</span>
                                    <input type='text' class='datepicker form-control' name='contract_date' value='" . date_format_rus($row['contract_date']) . "'>
                                </div>
                              </td>
                          </tr>
                          <tr>
                              <td>Номер акта сдачи-приемки</td>
                              <td><textarea class='form-control' name='act_number'>{$row['act_number']}</textarea></td>
                          </tr>
                          <tr>
                              <td>Дата акта сдачи-приемки</td>
                              <td>
                                <div class='input-group'>
                                    <span class='input-group-addon'>Дата</span>
                                    <input type='text' class='datepicker form-control' name='act_date' value='" . date_format_rus($row['act_date']) . "'>
                                </div>
                              </td>
                          </tr>
                    ");
                    echo("<tr><td colspan='2'>Внутренний регистрационный номер</td><td><textarea class='form-control' name='reg_num'>{$row['reg_num']}</textarea></td></tr>");
                    echo("<tr><td colspan='2'>Объем работ, выполненных Институтом, руб.</td><td><textarea class='form-control' name='volumeJob'>{$row['volumeJob']}</textarea></td></tr>");
                    echo("<tr><td colspan='2'>Виды работ, входившие в состав проекта и выполненные институтом</td><td><textarea class='form-control' name='typeJob'>{$row['typeJob']}</textarea></td></tr>");
                    echo("<tr>
                            <td colspan='2'>Источник финансирования</td>
                            <td>");
                    edit_financing($row['financing']);
                    echo("  </td>
                          </tr>");
                    echo("<tr><td colspan='2'>Уровень</td><td><select name='lvl' class='chosen-select-simple'>");
                    $lvls = array("Российский", "Международный");
                    editsOptions($lvls, $row['lvl']);
                    echo("</select></td></tr>");
                    echo("<tr><td colspan='2'>Основные результаты выполненных работ</td><td><textarea class='form-control' name='result'>{$row['result']}</textarea></td></tr>");
                    echo("<tr><td colspan='2'>Документ, подтверждающий тематику и качество работ (акты и т.д.)</td>");
                    // изменение прикрепленных файлов
                    edit_files($linki, $row['copy_docs']);
                    echo("<tr><td colspan='2'>Приоритетное направление</td><td><select name='priority' class='chosen-select-simple'>");
                    $arrPrior = fromPrior();
                    editsOptions($arrPrior, $row['priority']);
                    echo("</select></td></tr>");
                    echo("<tr><td colspan='2'>НИР</td><td><select name='nir' class='chosen-select-simple'>");
                    $nirs = array("Нет", "Да");
                    editsOptions($nirs, $row['nir']);
                    echo("</select></td></tr>");
                    echo("<tr>
                                <td colspan='3'class='table-head'>Соисполнители работ</td>");
                    if ($row['coauthors'] != "") {
                        $coauthors = explode(";", substr($row['coauthors'], 0, -1));
                        foreach ($coauthors as $k => $v) {
                            $num = $k + 1;
                            $result = mysqli_query($linki, "SELECT * FROM coauthors WHERE id=$v;") or die(mysqli_error($link));
                            $row_ca = mysqli_fetch_assoc($result) or die(mysqli_error($link));
                            echo("<tr><td colspan='3'>Соисполнитель $num</td></tr>
                            <input type='hidden' value='{$row_ca["id"]}' name='id_coauthor[]' >
                            <tr><td colspan='2'>Наименование соисполнителя</td>
                                <td>
                                    <textarea class='form-control' name='coauthor_name[]'>{$row_ca['name']}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2'>Цена контракта</td>
                                <td><textarea class='form-control' name='price_contract[]'>{$row_ca['price']}</textarea></td>
                            </tr>
                            <tr>
                                <td colspan='2'>Виды выполняемых работ</td>
                                <td><textarea class='form-control' name='type_job[]'>{$row_ca['type']}</textarea></td>
                            </tr>
                        ");
                        }
                        echo("<tr><td colspan='3'></td></tr>");
                    } else {
                        echo("</tr>");
                    }
                    echo("<tr><td colspan='2'>Код по ГРНТИ</td>
                              <td>");
                    //<select name='grnti' class='chosen-select' data-placeholder='Выберите'>");
                    fromGRNTI($linki, $id);
                    //echo("        </select>
                    echo("</td>
                          </tr>
                          <tr>
                              <td colspan='3' class='table-head'>
                                  <input type='hidden' value='{$id}' name='id'>
                                  <input type='submit' value='Сохранить изменения' name='save' class='btn btn-download'>
                              </td>
                          </tr>");
                    $date_create = $row['date_create'];
                    $last_edit = $row['last_edit'];
                }
                ?>
            </table>
        </form>
    </div>
    <?
    if (user_can("admin", $usr_id)) {
        echo("<small>Создано : " . $date_create . "</small><br>");
        echo("<small>Последнее изменение : " . $last_edit . "</small>");
    } else {
        echo("<small>Последнее изменение : " . substr($last_edit, -16) . "</small>");
    }
}

function table2($link, $usr_id)
{
    $header = "Сведения о результатах научно-исследовательской деятельности";
    include_once("../doc/header2.php");
    if (!valid_user()) {
        include_once($_SERVER['DOCUMENT_ROOT'] . "/information_system/authorize.php");
        exit;
    }
    ?>
    <script type="text/javascript" src="/js/jquery.MultiFile_new.js"></script>
    <div class="info_container">
        <input type="button" onclick="history.back();" value="Назад" class='btn btn-warning'>
        <!--<form action="test2.php" method="post" enctype="multipart/form-data" name="firstTable">-->
        <form action="update_edit.php" method="post" enctype="multipart/form-data" name="firstTable" id="form2">
            <input type="hidden" name="table2">
            <table class="table-info table-edit">
                <?php
                $id = $_POST['id'];
                mysql_select_db('billing_test');
                $query = "SELECT * FROM result_info WHERE id=" . $id . ";"; // запрос выборки таблицы
                $result = mysql_query($query) or die ("ERR"); // сохроняем результат запроса
                while ($row = mysql_fetch_assoc($result)) {
                    echo("<tr>
                    <td colspan='3' class='table-head'>
                        <input type='hidden' value='{$id}' name='id'>
                        <input type='button' name='save' class='btn btn-download' value='Сохранить' onclick=\"external_authors_dupl('#form2')\">
                    </td>
                    </tr>");
                    echo("<tr><td colspan='2'>Наименование результата научно-технической деятельности (РНТД)</td><td><textarea class='form-control' name='name_job'>{$row['name_job']}</textarea></td></tr>");
                    echo("<tr><td colspan='2'>Вид сохранного документа, № (индекс), дата</td><td><textarea class='form-control' name='type_docs'>{$row['type_docs']}</textarea></td></tr>");
                    echo("<tr><td colspan='2'>ВИД результата интеллектуальной деятельности</td><td><select name='type_result' class='chosen-select-simple'>");
                    $type_results = array("Секрет производства (ноу-хау)",
                        "Программа для ЭВМ",
                        "База данных",
                        "Изобретение",
                        "Полезная модель",
                        "Промышленный образец",
                        "Селекционное достижение");
                    editsOptions($type_results, $row['type_result']);
                    echo("</select></td></tr>");
                    // авторы
                    echo("<tr><td colspan='2'>Авторы</td><td>");
                    echo('<select class="chosen-select" name="authors[]" multiple data-placeholder="Выберите">');
                    edit_multiple_authors($linki, $row['authors']);
                    echo('</select>');
                    echo('
                    <div class="checkbox">
                      <label><input type="checkbox" id="chek" onchange = \'showOrHide("chek", "oth_aut");\'>Автора нет в списке</label>
                    </div>
                        <div id="oth_aut" class="oth_aut" style="display: none">
                            <input type="button" onclick="clone()" value="Добавить еще" class="btn">
                            <div class="selects">
                                <div class="select-editable sel" name="author">
                                    <input type="text" name="oth_aut" value="" class="form-control"/>
                                    <input type="button" class="btn btn-download" onclick="delRowAuthor(this.parentNode)" value="Удалить">
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </td>
                    ');
                    echo("<tr><td colspan='2'>Территория (страна)</td><td><textarea class='form-control' name='country'>{$row['country']}</textarea></td></tr>");
                    echo("<tr><td rowspan='2'>Срок действия</td>
                        <td>Начало</td>
                        <td>
                            <div class='input-group'>
                                <span class='input-group-addon'>Дата</span>
                                <input type='text' class='datepicker form-control' name='begin' value='" . date_format_rus($row['begin']) . "'>
                            </div>
                        </td>
                    </tr>");
                    echo("<tr>
                            <td>Окончание</td>
                            <td>
                                <div class='input-group'>
                                    <span class='input-group-addon'>Дата</span>
                                    <input type='text' class='datepicker form-control' name='end' value='" . date_format_rus($row['end']) . "'>
                                </div>
                            </td>
                          </tr>");
                    echo("<tr><td colspan='2'>Владелец прав</td><td><select name='holder' class='chosen-select-simple'>");
                    $holders = array("РНТД, права на которые принадлежат Российской Федерации",
                        "РНТД, права на которые принадлежат ФГБНУ НИИ РИНКЦЭ",
                        "РНТД, права на которые принадлежат третьим лицам");
                    editsOptions($holders, $row['holder']);
                    echo("</select></td></tr>");
                    echo("<tr><td colspan='2'>Копии соответствующих документов</td>");
                    // изменение прикрепленных файлов
                    edit_files($linki, $row['copy_docs']);
                    echo("</tr>");
                    echo("<tr><td rowspan='2'>Востребованность РИД</td><td>НИР</td><td>");
                    echo("<select name='nir[]' multiple class='chosen-select' data-placeholder='Выбрать'>");
                    /*__________________*/
                    fromNameJob($row['nir']);
                    echo("</select>");
                    echo("</td></tr>");
                    echo("<tr><td>Заключено лицензионное соглашение или оформлены договоры о передаче прав (Уточнить)</td><td>");
                    echo("<strong>Название договора: </strong><textarea class='form-control' name='name_contract'>{$row['name_contract']}</textarea>");
                    echo("<strong>Номер договора: </strong><textarea class='form-control' name='num_contract'>{$row['num_contract']}</textarea>");
                    echo("<strong>Сумма, руб: </strong><textarea class='form-control' name='summ_rub'>{$row['summ_rub']}</textarea>");
                    echo("</td></tr>");
                    echo("<tr><td colspan='2'>Регистрация/правовая охрана по классификации</td>
                              <td><select name='status_rid' class='chosen-select-simple'>");
                    $statuses = array("Учтена в государственных информационных системах",
                        "Имеет государственную регистрацию и (или) правовую охрану в Российской Федерации",
                        "Имеет правовую охрану за пределами Российской Федерации");
                    editsOptions($statuses, $row['status_rid']);
                    echo("</select></td></tr>");
                    echo("<tr>
                    <td colspan='3' class='table-head'>
                        <input type='hidden' value='{$id}' name='id'>
                        <!--<input type='submit' value='Сохранить изменения' name='save' class='btn btn-download'>-->
                        <input type='button' name='save' class='btn btn-download' value='Сохранить' onclick=\"external_authors_dupl('#form2')\">
                    </td>
                    </tr>");
                    $date_create = $row['date_create'];
                    $last_edit = $row['last_edit'];
                }
                ?>
            </table>
        </form>
    </div>
    <?
    if (user_can("admin", $usr_id)) {
        echo("<small>Создано : " . $date_create . "</small><br>");
        echo("<small>Последнее изменение : " . $last_edit . "</small>");
    } else {
        echo("<small>Последнее изменение : " . substr($last_edit, -16) . "</small>");
    }
}

function table3($link, $usr_id)
{
    $header = "Сведения о награждении ФГБНУ НИИ РИНКЦЭ дипломами, грамотами и сертификатами";
    include_once("../doc/header2.php");
    if (!valid_user()) {
        include_once($_SERVER['DOCUMENT_ROOT'] . "/information_system/authorize.php");
        exit;
    }
    ?>
    <script type="text/javascript" src="/js/jquery.MultiFile_new.js"></script>
    <div class="info_container">
        <input type="button" onclick="history.back();" value="Назад" class='btn btn-warning'>
        <!--<form action="test2.php" method="post" enctype="multipart/form-data" name="firstTable">-->
        <form action="update_edit.php" method="post" enctype="multipart/form-data" name="firstTable">
            <input type="hidden" name="table3">
            <table class="table-info table-edit">
                <?php
                $id = $_POST['id'];
                mysql_select_db('billing_test');
                $result = mysql_query("SELECT * FROM info_diplomas WHERE id=" . $id . "") or die (mysql_error()); // сохроняем результат запроса
                while ($row = mysql_fetch_assoc($result)) {
                    echo("<tr><td>Наименование</td><td><textarea class='form-control' name='name'>{$row['name']}</textarea></td></tr>");
                    echo("<tr><td>Вид документа, № (индекс)</td><td><textarea class='form-control' name='view_doc'>{$row['view_doc']}</textarea></td></tr>");
                    echo("<tr>
                            <td>Дата</td>
                            <td>
                              <div class='input-group'>
                                  <span class='input-group-addon'>Дата</span>
                                  <input type='text' class='datepicker form-control' name='date' value='" . date_format_rus($row['date']) . "'>
                              </div>
                            </td>
                          </tr>");
                    echo("<tr><td>Копии соответствующих документов</td>");
                    // изменение прикрепленных файлов
                    edit_files($linki, $row['copy_docs']);
                    echo("</tr>");
                    echo("<tr><td>Документ получен в рамках реализации работ</td><td><select data-placeholder='Выбор документов' multiple name='doc_work[]' class='chosen-select'>");
                    fromNameJob($row['doc_work']);
                    echo("</select></td></tr>");
                    echo("<tr>
                            <td colspan='3' class='table-head'>
                                <input type='hidden' value='{$id}' name='id'>
                                <input type='submit' value='Сохранить изменения' name='save' class='btn btn-download'>
                            </td>
                          </tr>");
                    $date_create = $row['date_create'];
                    $last_edit = $row['last_edit'];
                }
                ?>
            </table>
        </form>
    </div>
    <?
    if (user_can("admin", $usr_id)) {
        echo("<small>Создано : " . $date_create . "</small><br>");
        echo("<small>Последнее изменение : " . $last_edit . "</small>");
    } else {
        echo("<small>Последнее изменение : " . substr($last_edit, -16) . "</small>");
    }
}

function table4($link, $usr_id)
{
    $header = "Сведения о квалификации коллектива исполнителей";
    include_once("../doc/header2.php");
    if (!valid_user()) {
        include_once($_SERVER['DOCUMENT_ROOT'] . "/information_system/authorize.php");
        exit;
    }
    ?>
    <script type="text/javascript" src="/js/jquery.MultiFile.for_4_table_new.js"></script>
    <div class="info_container">
        <input type="button" onclick="history.back();" value="Назад" class='btn btn-warning'>
        <!--<form action="test4.php" method="post" enctype="multipart/form-data" name="firstTable">-->
        <form action="update_edit.php" method="post" enctype="multipart/form-data" name="firstTable">
            <input type="hidden" name="table4">
            <table class="table-info table-edit">
                <?php
                $id = $_POST['id'];
                mysql_select_db('billing_test');
                $query = "SELECT * FROM info_qualif WHERE id=" . $id . ";"; // запрос выборки таблицы
                $result = mysql_query($query) or die (mysql_error()); // сохроняем результат запроса
                while ($row = mysql_fetch_assoc($result)) {
                    echo("<tr>
                    <td colspan='3' class='table-head'>
                        <input type='hidden' value='{$id}' name='id'>
                        <input type='submit' value='Сохранить изменения' name='save' class='btn btn-download'>
                    </td>
                    </tr>");
                    echo("<tr><td colspan='2'>ФИО</td><td><textarea class='form-control' name='fio'>{$row['fio']}</textarea></td></tr>");
                    echo("<tr><td colspan='2'>Дата рождения</td>
                        <td>
                            <div class='input-group'>
                                <span class='input-group-addon'>Дата</span>
                                <input type='text' class='datepicker form-control' name='age_date' value='" . date_format_rus($row['age_date']) . "'>
                            </div>
                        </td>
                        </tr>");
                    echo("<tr><td colspan='2'>Место работы</td><td><textarea class='form-control' name='job'>{$row['job']}</textarea></td></tr>");
                    edit_position($linki, $id);
                    echo("<tr><td colspan='2'>Ученое звание</td><td><select name='academic_rank' class='chosen-select-simple'><option value=''>Нет</option>");
                    $arrRank = fromRankReturn();
                    editsOptions($arrRank, ($row['academic_rank'] != '' ? $row['academic_rank'] : 'без ученого звания'));
                    echo("</select></td></tr>");
                    echo("<tr><td colspan='2'>Ученая степень</td><td><select name='degree' class='chosen-select-simple'><option value=''>Нет</option>");
                    $arrDegree = fromDegreeReturn();
                    editsOptions($arrDegree, ($row['degree'] != '' ? $row['degree'] : 'без ученой степени'));
                    echo("</select></td></tr>");
                    echo("<tr><td colspan='2'>Специальность</td><td><textarea class='form-control' name='specialty'>{$row['specialty']}</textarea></td></tr>");

                    /*echo("<tr><td colspan='2'>Статус сотрудника</td><td><select name='status_person' class='chosen-select-simple'>");
                    $statuses = array("Осн.",
                        "Совм.",
                        "Вн. совм.",
                        "Уволен)");
                    editsOptions($statuses, $row['status_person']);
                    echo("</select></td></tr>");*/

                    echo("<tr><td colspan='2'>Дата начала работы в организации</td>
                        <td>
                            <div class='input-group'>
                                <span class='input-group-addon'>Дата</span>
                                <input type='text' class='datepicker form-control' name='begin_job' value='" . date_format_rus($row['begin_job']) . "'>
                            </div>
                        </td>
                    </tr>");
                    echo("<tr><td colspan='2'>Резюме</td><td><textarea class='form-control' name='resume'>{$row['resume']}</textarea></td></tr>");
                    echo("<tr><td colspan='2'>Копии документов, подтверждающих квалификацию персонала и подтверждающих наличие их в штате</td>");
                    // изменение прикрепленных файлов
                    edit_files($linki, $row['copy_docs']);
                    echo("</tr>");
                    echo("<tr><td colspan='2'>SPIN</td><td><textarea class='form-control' name='spin'>{$row['spin']}</textarea></td></tr>");
                    echo("<tr><td colspan='2'>Researcher ID</td><td><textarea class='form-control' name='researcher_id'>{$row['researcher_id']}</textarea></td></tr>");
                    echo("<tr><td colspan='2'>Идентификатор ученого в ИС Карта Российской Науки</td><td><textarea class='form-control' name='id_scientist'>{$row['id_scientist']}</textarea></td></tr>");
                    echo("<tr><td rowspan='5'>База данных Scopus:</td>
                            <td>Число публикаций за 5 предшествующих лет</td>
                            <td>
                                <textarea class='form-control' name='scopus_publ_5years'>{$row['scopus_publ_5years']}</textarea>
                            </td>
                          </tr>
                          <tr>
                            <td>Число публикаций за весь период</td>
                            <td>
                                <textarea class='form-control' name='scopus_publ_all'>{$row['scopus_publ_all']}</textarea>
                            </td>
                          </tr>
                          <tr>
                            <td>Число цитирований за 5 предшествующих лет</td>
                            <td>
                                <textarea class='form-control' name='scopus_quot_5year'>{$row['scopus_quot_5year']}</textarea>
                            </td>
                          </tr>
                          <tr>
                            <td>Число цитирований за весь период</td>
                            <td>
                                <textarea class='form-control' name='scopus_quot_all'>{$row['scopus_quot_all']}</textarea>
                            </td>
                          </tr>
                          <tr>
                            <td>Индекс Хирша</td>
                            <td>
                                <textarea class='form-control' name='scopus_hindex'>{$row['scopus_hindex']}</textarea>
                            </td>
                          </tr>
                          <tr>
                            <td rowspan='5'>База данных 'Сеть науки' (Web of Sience):</td>
                            <td>Число публикаций за 5 предшествующих лет</td>
                            <td>
                                <textarea class='form-control' name='science_publ_5years'>{$row['science_publ_5years']}</textarea>
                            </td>
                          </tr>
                          <tr>
                            <td>Число публикаций за весь период</td>
                            <td>
                                <textarea class='form-control' name='science_publ_all'>{$row['science_publ_all']}</textarea>
                            </td>
                          </tr>
                          <tr>
                            <td>Число цитирований за 5 предшествующих лет</td>
                            <td>
                                <textarea class='form-control' name='science_quot_5years'>{$row['science_quot_5years']}</textarea>
                            </td>
                          </tr>
                          <tr>
                            <td>Число цитирований за весь период</td>
                            <td>
                                <textarea class='form-control' name='science_quot_all'>{$row['science_quot_all']}</textarea>
                            </td>
                          </tr>
                          <tr>
                            <td>Индекс Хирша</td>
                            <td>
                                <textarea class='form-control' name='science_hindex'>{$row['science_hindex']}</textarea>
                            </td>
                          </tr>
                          <tr>
                            <td rowspan='5'>База данных РИНЦ:</td>
                            <td>Число публикаций за 5 предшествующих лет</td>
                            <td>
                                <textarea class='form-control' name='rinc_publ_5years'>{$row['rinc_publ_5years']}</textarea>
                            </td>
                          </tr>
                          <tr>
                            <td>Число публикаций за весь период</td>
                            <td>
                                <textarea class='form-control' name='rinc_publ_all'>{$row['rinc_publ_all']}</textarea>
                            </td>
                          </tr>
                          <tr>
                            <td>Число цитирований за 5 предшествующих лет</td>
                            <td>
                                <textarea class='form-control' name='rinc_quot_5years'>{$row['rinc_quot_5years']}</textarea>
                            </td>
                          </tr>
                          <tr>
                            <td>Число цитирований за весь период</td>
                            <td>
                                <textarea class='form-control' name='rinc_quot_all'>{$row['rinc_quot_all']}</textarea>
                            </td>
                          </tr>
                          <tr>
                            <td>Индекс Хирша</td>
                            <td>
                                <textarea class='form-control' name='rinc_hindex'>{$row['rinc_hindex']}</textarea>
                            </td>
                          </tr>
                    ");
                    echo("<tr>
                    <td colspan='3' class='table-head'>
                        <input type='hidden' value='{$id}' name='id'>
                        <input type='submit' value='Сохранить изменения' name='save' class='btn btn-download'>
                    </td>
                    </tr>");
                    $date_create = $row['date_create'];
                    $last_edit = $row['last_edit'];
                }
                ?>
            </table>
        </form>
    </div>
    <?
    if (user_can("admin", $usr_id)) {
        echo("<small>Создано : " . $date_create . "</small><br>");
        echo("<small>Последнее изменение : " . $last_edit . "</small>");
    } else {
        echo("<small>Последнее изменение : " . substr($last_edit, -16) . "</small>");
    }
}

function table5($link, $usr_id)
{
    $header = "Почетные звания, награды и премии";
    include_once("../doc/header2.php");
    if (!valid_user()) {
        include_once($_SERVER['DOCUMENT_ROOT'] . "/information_system/authorize.php");
        exit;
    }
    ?>
    <script type="text/javascript" src="/js/jquery.MultiFile_new.js"></script>
    <div class="info_container">
        <input type="button" onclick="history.back();" value="Назад" class='btn btn-warning'>
        <form action="update_edit.php" method="post" enctype="multipart/form-data" id="form5">
            <input type="hidden" name="table5">
            <table class="table-info table-edit">
                <?php
                $id = $_POST['id'];
                mysql_select_db('billing_test');
                $query = "SELECT * FROM awards WHERE id=" . $id; // запрос выборки таблицы
                $result = mysql_query($query) or die (mysql_error()); // сохроняем результат запроса
                while ($row = mysql_fetch_assoc($result)) {
                    echo("<tr>
                    <td colspan='3' class='table-head'>
                        <input type='hidden' value='{$id}' name='id'>
                        <!--<input type='submit' value='Сохранить изменения' name='save' class='btn btn-download'>-->
                        <input type='button' name='save' class='btn btn-download' value='Сохранить' onclick=\"external_authors_dupl('#form5')\">
                    </td>
                    </tr>");
                    echo("<tr><td>Авторы</td><td>");
                    echo('<select class="chosen-select" name="authors[]" multiple data-placeholder="Выберите"">');
                    edit_multiple_authors($linki, $row['authors']);
                    echo('</select>');
                    echo('
                    <div class="checkbox">
                        <label><input type="checkbox" id="chek" onchange=\'showOrHide("chek", "oth_aut");\'>Автора нет в списке</label>
                    </div>
                    
                        <div id="oth_aut" class="oth_aut" style="display: none">
                            <div class="item-with-padding">
                                <input type="button" onclick="clone()" value="Добавить еще" class="btn btn-download">
                            </div>

                            <div class="selects">
                                <div class="select-editable sel">
                                    <input type="text" name="oth_aut" value="" class="form-control"/>
                                    <input type="button" class="btn btn-download" onclick="delRowAuthor(this.parentNode)"
                                           value="Удалить"><hr>
                                </div>
                            </div>
                        </div></td>
                    ');
                    echo("<tr><td>Почетные звания награды и премии</td><td><textarea class='form-control' name='awards'>{$row['awards']}</textarea></td></tr>");
                    echo("<tr><td>Кем присуждены (выдана)</td><td><textarea class='form-control' name='issued'>{$row['issued']}</textarea></td></tr>");
                    echo("<tr><td>Год присуждения (получения)</td><td><select name='date' class='chosen-select-simple'>");
                    $arrRange = range(1991, 2016);
                    editsOptions($arrRange, $row['date']);
                    echo("</select></td></tr>");
                    echo("<tr><td>Достижение, за которое присуждено почетное звание (вручена премия, награда)</td><td><textarea class='form-control' name='achievement'>{$row['achievement']}</textarea></td></tr>");
                    echo("<tr><td>Работа выполнена в рамках темы</td><td>");
                    echo('<select class="chosen-select" name="works[]" multiple data-placeholder="Выберите"">');
                    fromNameJob($row['works']);
                    echo("</select></td></tr>");
                    echo("<tr><td>Копии документов</td>");
                    // изменение прикрепленных файлов
                    edit_files($linki, $row['copy_docs']);
                    echo("<tr>
                    <td colspan='3' class='table-head'>
                        <input type='hidden' value='{$id}' name='id'>
                        <!--<input type='submit' value='Сохранить изменения' name='save' class='btn btn-download'>-->
                        <input type='button' name='save' class='btn btn-download' value='Сохранить' onclick=\"external_authors_dupl('#form5')\">
                    </td>
                    </tr>");
                    $date_create = $row['date_create'];
                    $last_edit = $row['last_edit'];
                }
                ?>
            </table>
        </form>
    </div>
    <?
    if (user_can("admin", $usr_id)) {
        echo("<small>Создано : " . $date_create . "</small><br>");
        echo("<small>Последнее изменение : " . $last_edit . "</small>");
    } else {
        echo("<small>Последнее изменение : " . substr($last_edit, -16) . "</small>");
    }
}

function table6($link, $usr_id)
{
    $header = "Публикации исследователей (статьи, опубликованные доклады)";
    include_once("../doc/header2.php");
    if (!valid_user()) {
        include_once($_SERVER['DOCUMENT_ROOT'] . "/information_system/authorize.php");
        exit;
    }
    ?>
    <script type="text/javascript" src="/js/jquery.MultiFile_new.js"></script>
    <div class="info_container">
        <input type="button" onclick="history.back();" value="Назад" class='btn btn-warning'>
        <!--<form action="test4.php" method="post" enctype="multipart/form-data" id="form6">-->
        <form action="update_edit.php" method="post" enctype="multipart/form-data" id="form6">
            <input type="hidden" name="table6">
            <table class="table-info table-edit">
                <?php
                $id = $_POST['id'];
                mysql_select_db('billing_test');
                $query = "SELECT * FROM publishing WHERE id=" . $id . ";"; // запрос выборки таблицы
                $result = mysql_query($query) or die (mysql_error()); // сохроняем результат запроса
                while ($row = mysql_fetch_assoc($result)) {
                    echo("<tr>
                    <td colspan='3' class='table-head'>
                        <input type='hidden' value='{$id}' name='id'>
                        <input type='button' name='save' class='btn btn-download' value='Сохранить' onclick=\"external_authors_dupl('#form6', 'oth_aut')\">
                    </td>
                    </tr>");
                    echo("<tr><td>Название издания</td><td><textarea class='form-control' name='name_publ'>{$row['name_publ']}</textarea></td></tr>");
                    // авторы
                    echo("<tr><td>Авторы</td><td>");
                    echo('<select class="chosen-select" name="authors[]" multiple data-placeholder="Выберите"">');
                    edit_multiple_authors($linki, $row['authors']);
                    echo('</select>');
                    echo('
                    <div class="checkbox">
                        <label><input type="checkbox" id="chek" onchange=\'showOrHide("chek", "oth_aut");\'>Автора нет в списке</label>
                    </div>
                        <div id="oth_aut" class="oth_aut" style="display: none">
                            <div class="selects">
                                <div class="select-editable sel" name="author">
                                    <input type="text" name="oth_aut" value="" class="form-control"/>
                                    <input type="button" class="btn btn-download" onclick="delRowAuthor(this.parentNode)" value="Удалить"><hr>
                                </div>
                            </div>
                            <input type="button" onclick="clone()" value="Добавить еще" class="btn btn-download">
                        </div></td>
                    ');
                    echo("
                    <tr>
                        <td>ISSN издание</td>
                        <td><textarea class='form-control' name='issn'>{$row['issn']}</textarea></td>
                    </tr>
                    <tr>
                        <td>Тираж экземпляров</td>
                        <td><textarea class='form-control' name='count_exampl'>{$row['count_exampl']}</textarea></td>
                    </tr>
                    <tr>
                        <td>Кол-во страниц</td>
                        <td><textarea class='form-control' name='count_pages'>{$row['count_pages']}</textarea></td>
                    </tr>
                    <tr>
                        <td>Дата принятия к печати</td>
                        <td>
                            <div class='input-group'>
                                <span class='input-group-addon'>Дата</span>
                                <input type='text' class='datepicker form-control' name='date_print' value='" . date_format_rus($row['date_print']) . "'>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Дата публикации</td>
                        <td>
                            <div class='input-group'>
                                <span class='input-group-addon'>Дата</span>
                                <input type='text' class='datepicker form-control' name='date_publ' value='" . date_format_rus($row['date_publ']) . "'>
                            </div>
                        </td>
                    </tr>
                    ");
                    echo("<tr><td>Название публикации</td><td><textarea class='form-control' name='title'>{$row['title']}</textarea></td></tr>");
                    echo("<tr><td>Том (номер, выпуск)</td><td><textarea class='form-control' name='vol'>{$row['vol']}</textarea></td></tr>");
                    echo("<tr><td>Год выпуска</td><td><select name='date' class='chosen-select-simple'>");
                    $arrRange = range(1991, 2016);
                    editsOptions($arrRange, $row['date']);
                    echo("<tr><td>Страницы</td><td><textarea class='form-control' name='pages'>{$row['pages']}</textarea></td></tr>");
                    echo("</select></td></tr>");
                    echo("<tr><td rowspan='6'>Вхождение в информационно-аналитические системы научного цитирования</td>
                              <td>
                                <p>Перечень Систем</p> <!--Оставить, без этого сбиваются стили-->
                              </td>
                          </tr>");
                    editWithCheck($row['sjr'], "SJR издания в базе данных Scopus", "chek_sjr", "sjr");
                    editWithCheck($row['science'], "Импакт-фактор издания в базе данных «Сеть науки» (WEB of Science)", "chek_science", "science");
                    editWithCheck($row['rinc'], "Наличие издания в РИНЦ, его импакт-фактор", "chek_rinc", "rinc");
                    editWithCheck($row['other_infosys'], "Другая информационно-аналитическая система", "chek_other_infosys", "other_infosys");
                    editWithCheck($row['google_scholar'], "Google Scholar", "chek_google_scholar", "google_scholar");
                    echo("<tr><td>Суммарное количество цитирований</td><td><textarea class='form-control' name='summ_quote'>{$row['summ_quote']}</textarea></td></tr>");
                    echo("<tr><td>Идентифиратор публикаций в системе</td><td><textarea class='form-control' name='id_publ'>{$row['id_publ']}</textarea></td></tr>");
                    echo("<tr><td>Копии документов</td>");
                    // изменение прикрепленных файлов
                    edit_files_6_table($linki, $row['copy_docs']);
                    echo("<tr><td>Работа выполнена в рамках темы</td><td>");
                    echo('<select class="chosen-select" name="works[]" multiple data-placeholder="Выберите"">');
                    fromNameJob($row['works']);
                    echo("</select></td></tr>");
                    echo("<tr>
                    <td colspan='3' class='table-head'>
                        <input type='hidden' value='{$id}' name='id'>
                        <!--<input type='submit' value='Сохранить изменения' name='save' class='btn btn-download'>-->
                        <input type='button' name='save' class='btn btn-download' value='Сохранить' onclick=\"external_authors_dupl('#form6', 'oth_aut')\">
                    </td>
                    </tr>");
                    $date_create = $row['date_create'];
                    $last_edit = $row['last_edit'];
                }
                ?>
            </table>
        </form>
    </div>
    <?
    if (user_can("admin", $usr_id)) {
        echo("<small>Создано : " . $date_create . "</small><br>");
        echo("<small>Последнее изменение : " . $last_edit . "</small>");
    } else {
        echo("<small>Последнее изменение : " . substr($last_edit, -16) . "</small>");
    }
}

function table7($link, $usr_id)
{
    $header = "Список монографий, учебных пособий, учебников, методических пособий и др";
    include_once("../doc/header2.php");
    if (!valid_user()) {
        include_once($_SERVER['DOCUMENT_ROOT'] . "/information_system/authorize.php");
        exit;
    }
    ?>
    <!--<script type="text/javascript" src="/js/jquery.MultiFile.js"></script>-->
    <script type="text/javascript" src="/js/jquery.MultiFile_new.js"></script>
    <div class="info_container">
        <input type="button" onclick="history.back();" value="Назад" class='btn btn-warning'>
        <!--<form action="test4.php" method="post" enctype="multipart/form-data" id="form7">-->
        <form action="update_edit.php" method="post" enctype="multipart/form-data" id="form7">
            <input type="hidden" name="table7">
            <table class="table-info table-edit">
                <?php
                $id = $_POST['id'];
                mysql_select_db('billing_test');
                $query = "SELECT * FROM monography WHERE id=" . $id; // запрос выборки таблицы
                $result = mysql_query($query) or die ("ERR"); // сохроняем результат запроса
                while ($row = mysql_fetch_assoc($result)) {
                    echo("<tr>
                    <td colspan='3' class='table-head'>
                        <input type='hidden' value='{$id}' name='id'>
                        <input type='button' name='save' class='btn btn-download' value='Сохранить' onclick=\"external_authors_dupl('#form7', 'ext_editor')\">
                        <!--<input type='submit' name='save' class='btn btn-download' value='Сохранить'>-->

                    </td>
                    </tr>");
                    echo("<tr><td>Название</td><td><textarea class='form-control' name='name'>{$row['name']}</textarea></td></tr>");
                    // авторы
                    echo("<tr><td>Авторы</td><td>");
                    echo('<select class="chosen-select" name="authors[]" multiple data-placeholder="Выберите">');
                    edit_multiple_authors($linki, $row['authors']);
                    echo('</select>');
                    echo('
                    <!-- Автора нет в списке -->
                    <div class="checkbox">
                        <label><input type="checkbox" id="chek" onchange=\'showOrHide("chek", "oth_aut");\'>Автора
                            нет в списке</label>
                    </div>
                        <div id="oth_aut" class="oth_aut" style="display: none">
                            <input type="button" onclick="clone()" value="Добавить еще" class="btn btn-warning">
                            <div class="selects">
                                <div class="select-editable sel" name="author">
                                    <input type="text" name="oth_aut" value="" class="form-control"/>
                                    <input type="button" class="btn" onclick="delRowAuthor(this.parentNode)"
                                           value="Удалить">
                                </div>
                            </div>
                        </div></td>
                    ');
                    echo("<tr><td>Год издания</td><td><textarea class='form-control' name='date'>{$row['date']}</textarea></td></tr>");
                    echo("
                    <tr>
                        <td>Дата принятия к печати</td>
                        <td>
                            <div class='input-group'>
                                <span class='input-group-addon'>Дата</span>
                                <input type='text' class='datepicker form-control' name='date_print' value='" . date_format_rus($row['date_print']) . "'>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Дата публикации</td>
                        <td>
                            <div class='input-group'>
                                <span class='input-group-addon'>Дата</span>
                                <input type='text' class='datepicker form-control' name='date_publ' value='" . date_format_rus($row['date_publ']) . "'>
                            </div>
                        </td>
                    </tr>");
                    echo("<tr><td>Издательство</td><td><textarea class='form-control' name='publ_house'>{$row['publ_house']}</textarea></td></tr>");
                    echo("<tr><td>ISBN</td><td><textarea class='form-control' name='isbn'>{$row['isbn']}</textarea></td></tr>");

                    // редакторы
                    echo("<tr><td>Редакторы</td><td>");
                    echo('<select class="chosen-select" name="editors[]" multiple data-placeholder="Выберите">');
                    edit_multiple_authors($linki, $row['editors']);
                    echo('</select>');
                    echo('
                    <!-- Редактора нет в списке -->
                    <div class="checkbox">
                        <label><input type="checkbox" id="chek_editors"
                                      onchange=\'showOrHide("chek_editors", "wrapper-external-editors");\'>Редактора
                            нет в списке</label>
                    </div>

                    <div id="wrapper-external-editors" style="display: none">
                        <input type="button" onclick="cloneEditor()" value="Добавить еще" class="btn">

                        <div class="ext-editors">
                            <div class="select-editable-editors">
                                <input type="text" name="ext_editor[]" value="" class="form-control"/>
                                <input type="button" class="btn" onclick="delExtEditor(this.parentNode)"
                                       value="Удалить">
                            </div>
                        </div>
                    </div></td>
                    ');
                    echo("<tr><td>Количество страниц</td><td><textarea class='form-control' name='str_len'>{$row['str_len']}</textarea></td></tr>");
                    echo("<tr><td>Объем в п.л.</td><td><textarea class='form-control' name='volume'>{$row['volume']}</textarea></td></tr>");
                    echo("<tr><td>Гриф</td><td><select name='grif' class='chosen-select-simple' data-placeholder='Выберать'>");
                    $grifs = array("",
                        "Учебно-методическое объединение",
                        "Научно-методический совет",
                        "Минобрнауки России",
                        "Другие федеральные органы исполнительной власти");
                    editsOptions($grifs, $row['grif']);
                    echo("</select></td></tr>");
                    echo("<tr><td>Краткая аннотация</td><td><textarea class='form-control' name='short_inf'>{$row['short_inf']}</textarea></td></tr>");
                    echo("<tr><td>Вид научной работы</td><td><select name='type_work' class='chosen-select-simple'>");
                    $types = array("Монографии", "Раздел монографии", "Раздел учебника", "Раздел книги", "Учебное (методическое) пособие", "Сборник трудов", "Прочее");
                    editsOptions($types, $row['type_work']);
                    echo("</select></td></tr>");
                    echo("<tr><td>Работа выполнена в рамках темы</td><td>");
                    echo("<select name='works[]' multiple class='chosen-select-simple' data-placeholder='Выбрать'>");
                    fromNameJob($row['works']);
                    echo("</select></td>");
                    echo("<tr><td>Копии соответствующих документов</td>");
                    // изменение прикрепленных файлов
                    edit_files($linki, $row['copy_docs']);
                    echo("</tr>");
                    echo("<tr>
                    <td colspan='3' class='table-head'>
                        <input type='hidden' value='{$id}' name='id'>
                        <input type='button' name='save' class='btn btn-download' value='Сохранить' onclick=\"external_authors_dupl('#form7', 'ext_editor')\">
                    </td>
                    </tr>");
                    $date_create = $row['date_create'];
                    $last_edit = $row['last_edit'];
                }
                ?>
            </table>
        </form>
    </div>
    <?
    if (user_can("admin", $usr_id)) {
        echo("<small>Создано : " . $date_create . "</small><br>");
        echo("<small>Последнее изменение : " . $last_edit . "</small>");
    } else {
        echo("<small>Последнее изменение : " . substr($last_edit, -16) . "</small>");
    }
}

function table8($link, $usr_id)
{
    $header = "Участие сотрудников в выставках, ярмарках, конференциях, конгрессах, круглых столах и иных мероприятиях";
    include_once("../doc/header2.php");
    if (!valid_user()) {
        include_once($_SERVER['DOCUMENT_ROOT'] . "/information_system/authorize.php");
        exit;
    }
    ?>
    <div class="info_container">
        <input type="button" onclick="history.back();" value="Назад" class='btn btn-warning'>
        <form action="update_edit.php" method="post" enctype="multipart/form-data" id="form8">
            <input type="hidden" name="table8">
            <table class="table-info table-edit">
                <?php
                $id = $_POST['id'];
                mysql_select_db('billing_test');
                $query = "SELECT * FROM conference WHERE id=" . $id; // запрос выборки таблицы
                $result = mysql_query($query) or die ("ERR"); // сохроняем результат запроса
                while ($row = mysql_fetch_assoc($result)) {
                    echo("<tr>
                    <td colspan='3' class='table-head'>
                        <input type='hidden' value='{$id}' name='id'>
                        <!--<input type='submit' value='Сохранить изменения' name='save' class='btn btn-download'>-->
                        <input type='button' name='save' class='btn btn-download' value='Сохранить' onclick=\"external_authors_dupl('#form8')\">
                    </td>
                    </tr>");
                    echo("<tr><td>Название конференции</td><td><textarea class='form-control' name='name_conf'>{$row['name_conf']}</textarea></td></tr>");
                    // авторы
                    echo("<tr><td>Участник</td><td>");
                    echo('<select class="chosen-select" name="authors[]" multiple data-placeholder="Выберите"">');
                    edit_multiple_authors($linki, $row['authors']);
                    echo('</select>');
                    echo('
                    <!-- Автора нет в списке -->
                    <div class="checkbox">
                        <label><input type="checkbox" id="chek" onchange=\'showOrHide("chek", "oth_aut");\'>Автора
                            нет в списке</label>
                    </div>
                    <div id="oth_aut" class="oth_aut" style="display: none">
                        <input type="button" onclick="clone()" value="Добавить еще" class="btn">
                        <div class="selects">
                            <div class="select-editable sel" name="author">
                                <input type="text" name="oth_aut" value="" class="form-control"/>
                                <input type="button" class="btn" onclick="delRowAuthor(this.parentNode)"
                                           value="Удалить">
                            </div>
                        </div>
                    </div></td>
                    ');
                    echo("<tr><td>Название доклада</td><td><textarea class='form-control' name='name_report'>{$row['name_report']}</textarea></td></tr>");
                    echo("<tr><td>Тип доклада</td><td><select name='type_report' class='chosen-select-simple'>");
                    $reports = array("Приглашенный",
                        "Обычный устный",
                        "Постер");
                    editsOptions($reports, $row['type_report']);
                    echo("</select></td></tr>");
                    echo("<tr><td>Место проведения</td><td><textarea class='form-control' name='loc'>{$row['loc']}</textarea></td></tr>");
                    echo("<tr><td>Дата</td><td>

                        <div class='input-group item-with-padding'>
                            <span class='input-group-addon'>Начало &nbsp&nbsp&nbsp&nbsp&nbsp</span>
                            <input type='text' class='datepicker form-control' name='date_begin' value=" . date_format_rus($row['date_begin']) . ">
                        </div>

                        <div class='input-group item-with-padding'>
                            <span class='input-group-addon'>Окончание</span>
                            <input type='text' class='datepicker form-control' name='date_end' value=" . date_format_rus($row['date_end']) . ">
                        </div>
                    </td></tr>");
                    echo("<tr><td>Язык доклада</td><td><textarea class='form-control' name='lang'>{$row['lang']}</textarea></td></tr>");
                    echo("<tr><td>Статус мероприятия</td><td><select name='status_event' class='chosen-select-simple'>");
                    $status_events = array("Международное",
                        "Российское",
                        "Региональное",
                        "Ведомственное");
                    editsOptions($status_events, $row['status_event']);
                    echo("</select></td></tr>");
                    echo("<tr><td>Вид участия</td><td><select name='type_involv' class='chosen-select-simple'>");
                    $type_involv = array("Организация и проведение",
                        "Выступление с докладом",
                        "Выставлен экспонат (технология, программа)",
                        "Участие в работе экспертной комиссии",
                        "Участие в обсуждении",
                        "Переговоры с потенциальными заказчиками");
                    editsOptions($type_involv, $row['type_involv']);
                    echo("</select></td></tr>");
                    echo("<tr><td>Работа выполнена в рамках темы</td><td>");
                    echo("<select name='works[]' multiple class='chosen-select' data-placeholder='Выбрать'>");
                    fromNameJob($row['works']);
                    echo("</select></td>");
                    echo("<tr>
                    <td colspan='3' class='table-head'>
                        <input type='hidden' value='{$id}' name='id'>
                        <!--<input type='submit' value='Сохранить изменения' name='save' class='btn btn-download'>-->
                        <input type='button' name='save' class='btn btn-download' value='Сохранить' onclick=\"external_authors_dupl('#form8')\">
                    </td>
                    </tr>");
                    $date_create = $row['date_create'];
                    $last_edit = $row['last_edit'];
                }
                ?>
            </table>
        </form>
    </div>
    <?
    if (user_can("admin", $usr_id)) {
        echo("<small>Создано : " . $date_create . "</small><br>");
        echo("<small>Последнее изменение : " . $last_edit . "</small>");
    } else {
        echo("<small>Последнее изменение : " . substr($last_edit, -16) . "</small>");
    }
}

//редактируем должность
function edit_position($link, $id)
{
    mysqli_select_db($link, 'billing_test');

    $query_personnel = "SELECT * FROM personnel
                                        INNER JOIN position USING(id_position)
                                        INNER JOIN unit USING(id_unit)
                                        LEFT JOIN department USING(id_department)
                                  WHERE id_info_qualif = '$id';";
    $result_personnel = mysqli_query($link, $query_personnel) or die(mysqli_error($link));

    echo("<tr><td colspan='2'>Должность</td><td>");

    echo("<div class='unit-position-block-wrapper'>");

    if (mysqli_num_rows($result_personnel) > 0) {
        while ($row = mysqli_fetch_assoc($result_personnel)) {
            ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="checkbox">
                        <label><input type="checkbox" name="del_position[]" value="<? echo $row['id_personnel'] ?>">Удалить
                            должность</label>
                    </div>
                    <div><? echo $row['name_unit'] ?></div>
                    <div><? echo $row['name_department'] ?></div>
                    <div><? echo $row['name_position'] ?></div>
                    <div><? echo 'Ставка : ' . $row['fte'] ?></div>
                    <div><? echo 'Статус : ' . $row['status'] ?></div>
                </div>
            </div>
            <?
        }
    }
    ?>

    <div>
        <input type="button" class="btn btn-download" value="Новая должность"
               onclick="showHide('#unit-position-block-wrapper')">
        <hr>
        <div id="unit-position-block-wrapper">
            <input type='button' class='btn' value='Добавить Должность' onclick='clonePosition()'>
            <div class="unit-position-block">
                <div class="unit-block">

                    <?
                    echo("<div class='unit-wrapper item-with-padding'><input type='button' class='btn item-with-padding' value='Удалить' onclick='delPosition(this);'><select name='unit[]' class='chosen-select-simple unit' data-placeholder='Выбрать центр' onchange=\"selectPosition(this, 'unit', $(this).parents().eq(2))\">
            <option value='0'></option>");
                    $query_unit = "SELECT * FROM unit;";
                    $result_unit = mysqli_query($link, $query_unit) or die (mysqli_error($link));
                    while ($row_unit = mysqli_fetch_assoc($result_unit)) {
                        echo("<option value='{$row_unit['id_unit']}'>{$row_unit['name_unit']}</option>");
                    }
                    ?>
                    </select></div>
                <?

                ?></div>
            <div class='position-block'></div>
        </div>
    </div></div></div></td></tr>
    <?

}

// редактирование типов работ
function edit_type_works($row)
{
    //присваиваем глобальной переменной значение поля, для того, чтобы в коде передать ее JS скрипту
    global $row_str_for_type_works_select;
    $row_str_for_type_works_select = $row;
    $options_1 = array('-----Выберите-----', 'Научные исследования и разработки', 'Товары, работы, услуги производственного характера');
    echo("
    <div class='type_works'>
        <div class='div_type_work1'>
            <select class='chosen-select-simple' name='select_type_work1' id='select_type_work1' onchange='next_select(this, " . " \"$row_str_for_type_works_select\"  " . ")'>");
    foreach ($options_1 as $k => $v) {
        $mark = '';
        if ($row[0] == $k)
            $mark = ' selected';

        echo("<option value='$k' $mark>$v</option>");
    }
    echo("  </select>
        </div>
        <div class='div_type_work2' id='div_type_work2'>
        </div>
    </div>");
}

// Редактирование источников финансирования
function edit_financing($row)
{
    global $row_str_for_finan_select;
    $row_str_for_finan_select = $row;
    $row = explode(';', $row);

    $selects = array('-----Выберите-----', 'Средства министерств, федеральных агенств, слежб и других ведомств',
        'Средства фондов поддержки научной, научно-технической и инновационной деятельности',
        'Средства субъектов федерации, местных бюджетов',
        'Средства российских хозяйствующих субъектов',
        'Средства иных внебюджетных российских источников и собтвенных вредств вуза (организации)',
        'Средства зарубежных источников');
    echo("
    <div class='financing'>
        <div class='financing1'>
            <select class='chosen-select-simple' name='select_financing1' id='select_financing1' onchange='next_select(this, " . " \"$row_str_for_finan_select\"  " . ")'>");

    foreach ($selects as $k => $v) {
        $mark = '';
        if ($row[0] == $k) {
            $mark = ' selected';
        }
        echo("<option value='$k' $mark>$v</option>");
    }
    echo("</select>
        </div>
        <div class='financing2'>
        </div>
    </div>");
}

// редактирование соисполнителей
//добавление новых файлов
function edit_files_6_table($link, $copy_docs)
{
    $id_files = explode(';', $copy_docs);
    $query = "SELECT * FROM files WHERE id = '{$id_files[0]}';";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);
    if ($row['type'] == 'link') {
        echo("<td>
            <!--Radio group for show/hide-->

            <!-- radio file -->
            <div class='radio'>
                <label><input type='radio' name='type_file' value='file' onclick='change_type_docs(this)'>Прикреплённый файл</label>
            </div>

            <!-- radio link -->
            <div class='radio'>
                <label><input checked type='radio' name='type_file' value='link' onclick='change_type_docs(this)'>Ссылка</label>
            </div>

            <div id='div_file' style='display: none'>
                <input id='input_file' type='file' name='userfile[]' class='multi' data-maxsize='80024'>
            </div>

            <div id='div_link' style='display: block'>
                <input id='input_link' type='text' name='userfile' value='{$row['orig_name']}' class='form-control'>
            </div>
        </td>");
    } else {
        echo("<td>
            <!--Radio group for show/hide-->
            <!-- radio file -->
            <div class='radio'>
                <label><input checked type='radio' name='type_file' value='file' onclick='change_type_docs(this)'>Прикреплённый файл</label>
            </div>

            <!-- radio link -->
            <div class='radio'>
                <label><input type='radio' name='type_file' value='link' onclick='change_type_docs(this)'>Ссылка</label>
            </div>

            <div id='div_file' style='display: block'>");
        mysql_select_db("billing_test"); // выбираем бд
        if ($copy_docs == "Нет файлов" || $copy_docs == "") { // если прикрепленных файлов нет, то просто делаем добавление новых
            echo("Файлов нет<hr><input type='file' name='userfile[]' class='multi' data-maxsize='80024'>");
        } else {
            echo("Файлы :<br>");
            $copy_docs = explode(" ", substr($copy_docs, 0, -1)); // парсим строку на id файлов
            foreach ($copy_docs as $value) { // перебираем id файлов
                $result = mysql_query("SELECT * from files WHERE id=$value;") or die(mysql_error()); // берем все записи файлов
                while ($row = mysql_fetch_array($result)) { // перебираем их
                    $filename = substr($row['orig_name'], 25); // обрезаем дирректорию в оригинальном имени файла
                    $type_file = $row['type'];
                    // не оч красивый код
                    $check_name = "check_del_files_" . $row['id'];
                    echo("
                    <div class='checkbox'>
                      <label><input type='checkbox' name='{$check_name}' value='{$row['id']}'>Удалить <strong>$filename [$type_file]</strong></label>
                    </div>

                    ");
                }
            }
            echo("<hr>");
            echo("
                <div class='checkbox'>
                  <label><input type='checkbox' id='input_file' onchange='showOrHide(\"input_file\", \"add_files\")'>Добавить новые</label>
                </div>
                <div style='display: none;' id='add_files'>Несколько файлов добавляйте по одному<input type='file' name='userfile[]' class='multi' data-maxsize='80024'></div>");
        }
        echo("
            </div>

            <div id='div_link' style='display: none'>
                <input id='input_link' type='text' name='userfile' value='{$row['orig_name']}' class='form-control'>
            </div>
        </td>");

    }
}

function edit_files($link, $copy_docs)
{
    mysqli_select_db($link, "billing_test"); // выбираем бд
    if ($copy_docs == "Нет файлов" || $copy_docs == "") { // если прикрепленных файлов нет, то просто делаем добавление новых
        echo("<td>Файлов нет<hr><input type='file' name='userfile[]' class='multi' data-maxsize='80024'></td>");
    } else {
        echo("<td>Файлы :<br>");
        $copy_docs = explode(" ", substr($copy_docs, 0, -1)); // парсим строку на id файлов
        foreach ($copy_docs as $value) { // перебираем id файлов
            $result = mysqli_query($link, "SELECT * from files WHERE id=$value;") or die(mysql_error()); // берем все записи файлов
            while ($row = mysqli_fetch_array($result)) { // перебираем их
                $filename = substr($row['orig_name'], 25); // обрезаем дирректорию в оригинальном имени файла
                $type_file = $row['type'];
                // не оч красивый код
                $check_name = "check_del_files_" . $row['id'];
                echo("
                <div class='checkbox'>
                  <label><input type='checkbox' name='{$check_name}' value='{$row['id']}'>Удалить <strong> $filename [$type_file]</strong></label>
                </div>");
            }
        }
        echo("<hr>");
        echo("
        <div class='checkbox'>
          <label><input id='chek_files' type='checkbox' value='' onclick='showOrHide(\"chek_files\", \"add_files\"); killFilesArray(this);'>Добавить новые</label>
        </div>

        <div style='display: none;' id='add_files'>
        <input type='hidden' name='clear-files' value='0' id='clear-files'>
        Несколько файлов добавляйте по одному
        <input type='file' name='userfile[]' class='multi' data-maxsize='80024'></div>");
        echo("</td>");
    }
}

//редактирование исполнителей
function edit_implementers($link, $implementers)
{
    if ($implementers == "") {
        echo("<input type='hidden' name='new_impl'>
                <input type='button' onclick='cloneAuthor()' class='btn' value='Добавить исполнителя'>
                <div class='clone_author_wrapper'>
                    <div class='clone_author'>
                    <div class='item-with-padding'>
                        <select class='chosen-select' name='authors[]' data-placeholder='Выберите'>");
        fromAuthors();
        echo("      </select></div>
                    <div class='item-with-padding'>
                        <select name='role_performer[]' class='chosen-select-simple'>
                            <option>Научный руководитель</option>
                            <option>Ответственный исполнитель</option>
                            <option>Исполнитель</option>
                         </select>
                    </div>
                    <div class='item-with-padding'>
                        <div class='form-group'>
                            <label for='part'>Относительная доля участия</label>
                            <input name='part[]' type='text' class='form-control' id='part' placeholder='Доля участия'>
                        </div>
                    </div>
                    <input type='button' class='btn btn-download' value='Удалить' onclick='delCloneAuthor(this.parentNode, \".clone_author\");'>
                    <hr>
                    </div>
                </div>");
    } else {
        $implementers = explode(";", $implementers); // массив значений id записей из табл. implementers из ячейки
        // перебираем id implementers
        echo("<input type='button' onclick='cloneAuthor()' class='btn btn-warning input-group'
                               value='Добавить исполнителя'/><div class='clone_author_wrapper'>");
        foreach ($implementers as $value) {
            $query = mysqli_query($link, "SELECT * FROM implementers WHERE id=$value;") or die(mysqli_error($link));
            $result_impl = mysqli_fetch_array($query);
            $id_impl = $result_impl['name'];// получаем id записи с именем исполнителя
            echo("<div class='clone_author'>");
            show_authors_select($link, $id_impl);
            $role = $result_impl['role']; //получаем роль исполнителя
            $role_arr = array("Научный руководитель", "Ответственный исполнитель", "Исполнитель");
            echo("<div class='item-with-padding'><select name='role_performer[]' class='chosen-select-simple'>");
            editsOptions($role_arr, $role);
            echo("</select></div>");
            $part = $result_impl['part'];
            echo("<div class='item-with-padding'>
                    <div class='form-group'>
                        <label for='part'>Относительная доля участия</label>
                        <input name='part[]' type='text' class='form-control' id='part' placeholder='Доля участия' value='$part'>
                    </div>
                </div>");

            echo("<div class='item-with-padding'><input type='button' class='btn btn-download' onclick='delCloneAuthor(this.parentNode.parentNode, \".clone_author\")' value='Удалить'/></div><hr>");
            echo("</div>");
        }
        echo("</div>");
    }
}

// подгрузка option's из таблицы авторов
function fromAuthors()
{
    mysql_select_db("billing_test") or die(mysql_error());
    $query = "SELECT * FROM authors ORDER BY fio;";
    $result = mysql_query($query) or die(mysql_error());
    echo("<option></option>");
    while ($row = mysql_fetch_assoc($result)) {
        echo("<option value='{$row['id']}'>{$row['fio']}</option>");
    }
}

// редактирование multiple авторов
function edit_multiple_authors($link, $id)
{
    mysqli_select_db($link, "billing_test");
    $id = explode(";", $id);
    $result = mysqli_query($link, "SELECT * FROM authors ORDER BY fio;") or die(mysqli_error($link));
    while ($row = mysqli_fetch_assoc($result)) { // перебираем все id авторов
        foreach ($id as $id_val) { // текущий id автора сравшиваем с авторами из списка
            $check = ""; // маркер
            if ($row['id'] == $id_val) {
                $check = " selected";
                break;
            }
        }
        echo("<option {$check} value='{$row['id']}'>{$row['fio']}</option>");
    }
}

// редактирование одиночных авторов
function show_authors_select($link, $id_selected)
{
    $result = mysqli_query($link, "SELECT * FROM authors ORDER BY fio;") or die(mysqli_error($link));
    echo("<div class='item-with-padding'><select class='chosen-select' name='authors[]' data-placeholder='Выберите'>");
    while ($row = mysqli_fetch_assoc($result)) {
        $check = ""; // маркер
        if ($row['id'] == $id_selected) {
            $check = " selected ";
        }
        echo("<option {$check} value='{$row['id']}'>{$row['fio']}</option>");
    }
    echo('</select></div>');
}

// editable combobox authors
function editableCombobox($row)
{
    $authorsNoSortArr = explode(";", $row); // массив с id и именами авторов
    $authorsArr = array();
    foreach ($authorsNoSortArr as $value) {
        array_push($authorsArr, idAuthorToText($value));
    }
    echo("<div class='selects'>");
    combobox($authorsArr);
    echo("</div>
          <input type='button' onclick='clone()' value='Добавить еще' class='button'></td></tr>");

}

// edits options
function editsOptions($array, $row)
{
    $chek = "";
    foreach ($array as $value) {
        if ($row == $value) $chek = " selected";
        echo("<option" . $chek . ">$value</option>");
        $chek = "";
    }
}

// textarea с checkbox'ом
function editWithCheck($row, $header, $index, $id)
{
    echo("<tr><td> ");
    $check = "";
    $disp = "none";
    if ($row != null) {
        $check = "checked";
        $disp = "block";
    }
    echo("
        <div class='checkbox'>
            <label>
                <input $check type='checkbox' id='$index' onchange='showOrHideFor6Table(\"$index\", \"$id\", \"$row\");'>$header
            </label>
        </div>
        
        <textarea class='form-control' style='display: $disp' id='$id' name='$id'>{$row}</textarea>");
    echo("</td></tr>");
}

// checkbox элементы input'a по Названию работы
function fromNameJob($nir)
{
    mysql_select_db("billing_test") or die(mysql_error());
    $nir = explode(";", $nir); // значение с id работ в массив
    $resultNamesJobs = mysql_query("SELECT * FROM work_performed;") or die(mysql_error()); // таблица с именами всех работ
    while ($row = mysql_fetch_assoc($resultNamesJobs)) { // строка с именем работы
        $check = ""; // маркер
        foreach ($nir as $value) { //
            if ($row['id'] == $value) {
                $check = " selected ";
            }
        }

        if ($row['beginJob'] == '0000-00-00') $beginJob = '';
        else $beginJob = $row['beginJob'] . ' ';

        if ($row['endJob'] == '0000-00-00') $endJob = '';
        else $endJob = $row['endJob'] . ' || ';

        echo("<option $check value='{$row['id']}'>$beginJob $endJob<br>{$row['nameJob']}</option>");
    }
}

//combobox с авторами
function combobox($authorsArray)
{
    //for($i = 0; $i < count($authorsArray); $i++) {
    for ($i = count($authorsArray) - 1; $i >= 0; $i--) {
        echo("
        <div class='select-editable sel" . $i . "' name='authors'>
            <select onchange='this.nextElementSibling.value=this.options[this.selectedIndex].text'>
                <option value=''></option>");
        from4Table();
        echo("</select>
            <input type='text' name='authors" . $i . "' value='$authorsArray[$i]'/>
            <a href='#' onclick=\"delRowAuthor(this.parentNode)\">x</a>
        </div>
        ");
    }
}

// множество авторов
function idAuthorToText($id)
{
    mysql_select_db("billing_test") or die(mysql_error());
    $author_name = "";
    $result = mysql_query("SELECT * FROM info_qualif") or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        if ($row['id'] == $id) {
            $author_name = $row['fio'];
        }
    }
    if ($author_name == "") {
        return $id;
    } else {
        return $author_name;
    }
}

// option элементы select'a по Авторам
function from4Table()
{ // option для select с данными из табл 4
    mysql_select_db("billing_test") or die(mysql_error());
    $query = "SELECT * FROM info_qualif";
    $result = mysql_query($query);
    while ($row = mysql_fetch_assoc($result)) {
        echo("<option value='{$row['id']}'>{$row['fio']}</option>");
    }
}

// option элементы select'a по Ученому званию
function fromRank()
{
    mysql_select_db("dwh_org") or die(mysql_error());
    $result = mysql_query("SELECT * FROM x_Zvanie WHERE ZvanieExists=1 AND IdZvanie NOT IN(18,19,20,21)");
    while ($row = mysql_fetch_assoc($result)) {
        echo("<option>{$row['ZvanieFull']}</option>");
    }
}

// option элементы select'a по Ученой степени
function fromDegree()
{
    mysql_select_db("dwh_org") or die(mysql_error());
    $result = mysql_query("SELECT * FROM x_Stepen");
    while ($row = mysql_fetch_assoc($result)) {
        echo("<option>{$row['StepenFull']}</option>");
    }
}

// option элементы select'a по Приоритетному направлению
function fromPrior()
{
    mysql_select_db("dwh_org") or die(mysql_error());
    $result = mysql_query("SELECT * FROM x_Prior;") or die(mysql_error());
    $arr = array();
    array_push($arr, "Нет");
    while ($row = mysql_fetch_assoc($result)) {
        array_push($arr, $row['text_prior']);
    }
    return $arr;
}

// воавращаемый массив элементов Ученое звание
function fromRankReturn()
{
    mysql_select_db("dwh_org") or die(mysql_error());
    $result = mysql_query("SELECT * FROM x_Zvanie WHERE ZvanieExists=1 AND IdZvanie NOT IN(18,19,20,21)") or die(mysql_error());
    $arr = array();
    while ($row = mysql_fetch_assoc($result)) {
        array_push($arr, $row['ZvanieFull']);
    }
    return $arr;
}

// воавращаемый массив элементов Ученая степень
function fromDegreeReturn()
{
    mysql_select_db("dwh_org") or die(mysql_error());
    $result = mysql_query("SELECT * FROM x_Stepen");
    $arr = array();
    $arr[] = 'кандидат наук';
    $arr[] = 'доктор наук';
    while ($row = mysql_fetch_assoc($result)) {
        array_push($arr, $row['StepenFull']);
    }
    return $arr;
}

function fromGRNTI($link, $id)
{
    ?>
    <input type="button" onclick="cloneGRNTI()" class="btn btn-warning input-group" value="Добавить код"/>
    <div class="grnti-wrapper">
        <?
        // select db
        mysqli_select_db($link, 'billing_test');

        // get all KODs
        $query_kod = "SELECT * FROM KlassifikatorGRNTI ORDER BY KOD;";

        // get value grnti
        $query_cross = "SELECT * FROM wp_grnti WHERE wp = $id;";
        $result_cross = mysqli_query($link, $query_cross);
        if (mysqli_num_rows($result_cross) > 0) { //  не пустой результат
            while ($row_cross = mysqli_fetch_assoc($result_cross)) {
                ?>
                <div class="grnti-block item-with-padding">
                    <select name="grnti[]" class="chosen-select" data-placeholder="Выберите" style="width: 85%">
                        <option value=''></option>
                        <?
                        $result_kod = mysqli_query($link, $query_kod) or die(mysqli_error($link));
                        while ($row_kod = mysqli_fetch_assoc($result_kod)) {
                            $mark = "";
                            if ($row_cross['grnti'] == $row_kod['KOD']) {
                                $mark = " selected";
                            }
                            $grnti_value = $row_kod['KOD'];
                            echo("<option $mark value='$grnti_value'><b>{$row_kod['KOD']}</b>&nbsp||&nbsp{$row_kod['TEXT']}</option>");
                        }
                        ?>
                    </select>
                    <input type="button" value="Удалить" class="btn" onclick="delParent(this.parentNode)">
                </div>
                <?
            }
        } else {
            // если для этой записи нет существующего кода ГРНТИ, то просто делаем обычный селект
            ?>
            <div class="grnti-block item-with-padding">
                <select name="grnti[]" class="chosen-select" data-placeholder="Выберите" style="width: 85%">
                    <option value=""></option>
                    <?
                    $result_kod = mysqli_query($link, $query_kod) or die(mysqli_error($link));
                    while ($row_kod = mysqli_fetch_assoc($result_kod)) {
                        $grnti_value = $row_kod['KOD'];
                        echo("<option value='$grnti_value'><b>{$row_kod['KOD']}</b>&nbsp||&nbsp{$row_kod['TEXT']}</option>");
                    }
                    ?>
                </select>
                <input type="button" value="Удалить" class="btn" onclick="delParent(this.parentNode)">
            </div>
            <?

        }

        ?>
    </div>
    <?
}

include("../doc/footer2.php");
?>
<script type="text/javascript">

    var unitPositionBlock;
    var cloneAuthorFirstTable;
    var externalImplementersBlock;

    // for 1 table
    function killFilesArray(obj) {

        if ($(obj).is(':checked')) {
            $('#clear-files').val('1');
        } else {
            $('#clear-files').val('0');
        }

    }

    // клонирование поля код грнти
    function cloneGRNTI() {
        var grnti = $('.grnti-block').last().clone();
        grnti.find('.chosen-select').val('');
        grnti.find('.chosen-select').css("display", "block").next().remove();

        $('.grnti-wrapper').append(grnti);

        grnti.find('.chosen-select').chosen();
    }

    // удалить родительский элемент
    function delParent(parent) {
        if ($('.grnti-block').length > 1) {
            $(parent.remove());
        } else {
            $(parent).find('.chosen-select').val('').trigger("chosen:updated");
        }
    }

    // for first table
    function delCloneAuthor(elem, clone_author) {
        if ($(clone_author).length > 1) {
            elem.remove();
        } else {
            $(elem).find('.chosen-select').val('').trigger("chosen:updated");
        }
    }

    function clonePosition() {

        $('.unit').each(function (index, elem) {
            if ($(elem).val() == 0) {
                console.log('Есть незаполненные поля');
                throw new Error('Есть незаполненные поля');
            }
        });

        $('#unit-position-block-wrapper').append(unitPositionBlock.first().clone().find('.chosen-select-simple')
            .css("display", "block")
            .next()
            .remove()
            .end().end());

        $('.chosen-select-simple').chosen({disable_search: 10});
    }
    function delPosition(obj) {
        var elem = $(obj).parents().eq(2);

        if ($('.unit-position-block').length > 1) {
            elem.remove();
        } else {
            elem.remove();
            clonePosition();
        }
    }

    // какой то адский ад
    window.onload = function () {
        next_select(select_financing, "<? echo $row_str_for_finan_select; ?>");
        next_select(select_type_work1, "<? echo $row_str_for_type_works_select; ?>");
    };

    // выбрать тип прикрепляемого документа. Файл/ссылка
    function change_type_docs(obj) {
        //console.log(obj);
        if (obj.value == 'file') {
            $("#div_file").show();
            $("#div_link").hide();
        }
        if (obj.value == 'link') {
            $("#div_link").show();
            $("#div_file").hide();
        }
    }

    // выбор должности (объеденить в дальнейшем с next_select)
    function selectPosition(select, token, parent) {
        console.log(select);
        console.log(token);

        var position = select.value;

        if (token == 'unit') {
            $.post(
                'ajax.php',
                {
                    unit_position: 'unit',
                    value: position
                },
                function (data) {

                    var positionBlock = parent;

                    if ($(data).find('.department').val() == null) {

                        positionBlock.find('.position-block').html($(data)
                            .find('.department')
                            .attr('data-placeholder', 'Нет')
                            .append("<option value='null'>Нет</option>")
                            .end());
                    } else {
                        positionBlock.find('.position-block').html(data);
                    }

                    $(".chosen-select-simple").chosen({disable_search: 10}); // chosen select
                }
            );
        }
    }

    //для 7 таблицы. клонирование поля со сторонним редактором
    function cloneEditor() {

        $('.select-editable-editors').first().clone()
            .find("input[name='ext_editor[]']")
            .val('')
            .end()
            .appendTo('.ext-editors');
    }

    // для 7 таблицы. удаления поля со сторонним редактором
    function delExtEditor(obj) {

        if ($('.select-editable-editors').length > 1) {
            obj.remove();
        } else {
            $(obj).children(".form-control").val("");
        }
    }

    // Источники финансирования
    var select_financing = $("#select_financing1");
    select_financing = select_financing[0];
    // типы работ
    var select_type_work1 = $("#select_type_work1");
    select_type_work1 = select_type_work1[0];

    // проверка на дублирование стороннего автора.
    function external_authors_dupl(send_form, field) {

        var form = $("input[name*=" + field + "]");

        $.get(
            'ajax.php',
            {
                check_external_author_duplicate: 'external',
                form: form.serialize()
            },
            function (data) {
                if (data == 0) {
                    $(send_form).submit();
                } else {
                    data = data.split('::');
                    var del_name = data[1],
                        del_elem = $('[name=' + del_name + ']');
                    alert(data[2] + ' ' + data[0] + " уже существует в системе! Выберите его из выпадающего списка всех авторов.");
                    del_elem.val('');
                }
            }
        );
    }

    function next_select(select, row_str) {
        var div_work2 = $('.financing2');
        if (select.name == 'select_financing1') {
            if (select.value == '1') {
                $.post(
                    'ajax.php',
                    {
                        get_select_financing: 'get_select_21',
                        selected: row_str
                    },
                    function (data) {
                        div_work2.html(data);
                        $(".chosen-select-simple").chosen({disable_search: 10}); // chosen select
                        $(".chosen-select").chosen(); // chosen select
                    }
                );
            }
            if (select.value == '2') {
                $.post(
                    'ajax.php',
                    {
                        get_select_financing: 'get_select_22',
                        selected: row_str
                    },
                    function (data) {
                        div_work2.html(data);
                        $(".chosen-select-simple").chosen({disable_search: 10}); // chosen select
                        $(".chosen-select").chosen(); // chosen select
                    }
                );
            }
            if (select.value != '1' || select.value != '2') {
                div_work2.empty();
            }
        }

        if (select.name == 'select_type_work1') {

            //console.log(select.value);

            var div_type_work2 = $('#div_type_work2');

            if (select.value != '0') {
                $.post(
                    'ajax.php',
                    {
                        get_select_type_work: 'get_select',
                        selected: row_str
                    },
                    function (data) {
                        div_type_work2.html(data);
                        $(".chosen-select").chosen({disable_search: 10}); // chosen select
                    }
                );
            } else {
                div_type_work2.empty();
            }
        }
    }
    // Копия
    var iii = 0;
    function cloneAuthor() {
        var myClone = $(".clone_author").last().clone();
        myClone.find('.chosen-select').css("display", "block");

        $(".clone_author_wrapper").append(myClone);
        $('.clone_author').last().find('.chosen-select').css("display", "block").next().remove();
        $('.clone_author').last().find('.chosen-select').chosen();

        $('.clone_author').last().find('.chosen-select-simple').css("display", "block").next().remove();
        $('.clone_author').last().find('.chosen-select-simple').chosen({disable_search: 10});

        $('.clone_author').last().find('.chosen-select-simple').val('').trigger("liszt:updated");

    }
    // del combobox
    function delRowAuthor(obj) {
        if ($(".select-editable").length > 1) {
            $(obj).remove();
        } else {
            $(obj).children(".form-control").val("");
        }
    }
    // show/hide textarea grom 2 tbl
    function showOrHideFor6Table(chek, demand, value) {
        chek = document.getElementById(chek);
        demand = document.getElementById(demand);

        if (chek.checked) {
            demand.style.display = "block";
            demand.value = value;
        }
        else {
            demand.style.display = "none";
            demand.value = "";
        }
    }
    //  По загрузке страницы
    $(function () {
        // Календарь
        $(".datepicker").datepicker({
            language: 'ru'
        });
        jQuery(function ($) {
            $.datepicker.regional['ru'] = {
                closeText: 'Закрыть',
                prevText: '&#x3c;Пред',
                nextText: 'След&#x3e;',
                currentText: 'Сегодня',
                monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                    'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                monthNamesShort: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                    'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
                dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
                dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
                weekHeader: 'Нед',
                dateFormat: 'dd.mm.yy',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''
            };
            $.datepicker.setDefaults($.datepicker.regional['ru']);
        });
        $('textarea').elastic();
        $(".chosen-select").chosen(); // chosen select
        $(".chosen-select-simple").chosen({disable_search: 10}); // chosen select
        $("#autoheight").attr("size", parseInt($("#autoheight option").length)); // autosize select multiple
        //next_select();

        $('input[type=file]').bootstrapFileInput();
        unitPositionBlock = $('.unit-position-block').clone();
        cloneAuthorFirstTable = $('.clone_author').clone();

        $('#unit-position-block-wrapper').hide();
        $('.external-authors-wrapper').hide();
        externalImplementersBlock = $('.external-authors').clone();

    });
    // Копия элемента
    var i = 0;
    function clone() {

        $('.select-editable').first().clone().attr('class', 'select-editable sel' + i)
            .find("input[name^='oth_aut']")
            .attr('name', 'oth_aut' + i++)
            .val('')
            .end()
            .appendTo('.selects');
    }
    // show-hide /*Нормально переписать*/
    function showOrHide(chek, elem) {
        chek = document.getElementById(chek);
        demand = document.getElementById(elem);
        if (chek.checked) demand.style.display = "block";
        else {
            elems = document.getElementsByClassName("select-editable");
            for (i = 0; i < elems.length; i++) {
                elems[i].children[0].value = "";
            }
            demand.style.display = "none";
        }
    }
    //simple show-hide for button
    function showHide(elem) {
        if ($(elem).is(':visible')) {
            $(elem).hide();
        } else {
            $(elem).show();
        }
    }
    // simple show/hide func FOR 1 TABLE!
    function showHide1Table(check, elem) {
        if ($(check).is(':checked')) {
            $(elem).show();
        } else {
            $(elem).hide();
            $('.name-author').val('');
            $('.part-author').val('');
            $('.external-authors').not(':first').remove();
        }
    }

    // for 1 table, clone external impl
    function cloneImplementer() {
        $('.external-authors').each(function (index, elem) {
            if ($(elem).find('.name-author').val() == 0) {
                console.log('Есть незаполненные поля');
                throw new Error('Есть незаполненные поля');
            }
        });

        $('.external-authors-wrapper').append(externalImplementersBlock.clone()
            .find('select')
            .css('display', 'block')
            .next()
            .remove()
            .end()
            .end());

        $('.chosen-select-simple').chosen({disable_search: 10});
    }

    // for 1 table, del impl
    function delImplementer(elem) {

        if ($('.external-authors').length > 1) {
            $(elem).remove();
        } else {
            $(elem).find('.name-author').val('');
            $(elem).find('.part-author').val('');
        }
    }
</script>