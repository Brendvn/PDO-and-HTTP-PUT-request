<?php
require_once ('ModelUser.php');
//echo json_encode($model->select());
if('POST' == $_SERVER['REQUEST_METHOD']){
    $model = new ModelUser();
    showUsers($model);
}
if('PUT' == $_SERVER['REQUEST_METHOD']) {
    $model = new ModelUser();
    $data = json_decode(file_get_contents('php://input')); //$_PUT contains put fields
    setModelUser($data,$model);
    addUsers($model);
}
function showUsers($model)
{
    $users = $model->select();
    echo createUserData($users);
}
function addUsers($model):void
{
    $model->insert();
}
function createUserData($users)
{
    $html = '';
    foreach ($users as $user) {
        $html .='<tr>';
        $html .='<td class="name">'.$user->name.'</td>';
        $html .='<td class="surname">'.$user->surname.'</td>';
        $html .='<td class="password">'.$user->password.'</td>';
        $html .='</tr>';
    }
    return $html;
}
function setModelUser($data,$model):void
{
    $model->name = $data->name;
    $model->surname = $data->surname;
    $model->password = $data->password;
}