<?php
function is_connected()
{
    $ci = &get_instance();
    // Pour plus d'infos car le $this ne marche pas
    // https://forum.codeigniter.com/thread-68202.html
    // https://stackoverflow.com/questions/4740430/explain-ci-get-instance
    $connected = false;
    if ($ci->session->has_userdata('usr_id') && $ci->session->has_userdata('usr_pseudo') && $ci->session->has_userdata('usr_mdp')) $connected = true;
    if (!$connected) redirect('User/');
    else return $connected;
}
function genererChaineAleatoire($longueur = 36)
{
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $longueurMax = strlen($caracteres);
    $chaineAleatoire = '';
    for ($i = 0; $i < $longueur; $i++) {
        $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
    }
    return $chaineAleatoire;
}
function is_admin(){
    $ci = &get_instance();
    if ($ci->session->has_userdata('usr_id') && $ci->session->has_userdata('usr_pseudo') && $ci->session->has_userdata('usr_mdp') && $ci->session->has_userdata('usr_rang')
    && $ci->session->userdata('usr_rang') == 10){
        return true;
    }
    else{
        return false;
    } 
}
function is_it_my_profil($my_id, $profil_id){
    $ci = &get_instance();
    $isItMyProfil= false;
    if($my_id == $profil_id){
        $isItMyProfil= true;
    }
   return $isItMyProfil;
}
//A FAIRE
function is_it_my_friend($my_id, $profil_id){
    $ci = &get_instance();
    $ci->load->model("ajouter_model", "ajouterManager");
    $isMyFriend = false;

    $count = $ci->ajouterManager->count_is_friend($my_id, $profil_id);

    
   if($count >= 1) $isMyFriend = true;
   return $isMyFriend;
}
function is_friend_request_pending($my_id, $profil_id){
    $ci = &get_instance();
    $ci->load->model("ajouter_model", "ajouterManager");
    $isFriendRequestPending = false;

    $count = $ci->ajouterManager->count_is_friend_request_pending($my_id, $profil_id);

    
   if($count >= 1) $isFriendRequestPending = true;
   return $isFriendRequestPending;
}

function do_i_follow_him($my_id, $profil_id){
    $ci = &get_instance();
    $ci->load->model("suivre_model", "suivreManager");
    $doIFollowHim = false;

    $count = $ci->suivreManager->is_following($my_id, $profil_id);

    
   if($count >= 1) $doIFollowHim = true;
   return $doIFollowHim;
}

function is_my_post($usr_id, $post_id){

}
function is_my_comment($usr_id, $commentaire_id){

}
