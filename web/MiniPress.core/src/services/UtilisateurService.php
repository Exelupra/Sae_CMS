<?php

namespace MiniPress\core\services;
use Illuminate\Database\Eloquent\Collection;
use MiniPress\core\models\Utilisateur;

class UtilisateurService
{

//
    public static function getUtilisateur(): Collection
    {
        return Utilisateur::all();
    }

    public static function getUtilisateurById($id)
    {
        return Utilisateur::find($id);
    }

    public static function getUtilisateurByMail($mail)
    {
        return Utilisateur::where('mail', $mail)->first();
    }

    public static function createUtilisateur($mail, $mdp, $admin)
    {
        $utilisateur = new Utilisateur();
        $utilisateur->id = $_SESSION['csrf_token'];
        $utilisateur->mail = $mail;
        $utilisateur->mdp = $mdp;
        $utilisateur->admin = $admin;
        $utilisateur->save();
        return $utilisateur;
    }

    public static function deleteUtilisateur($id)
    {
        $utilisateur = Utilisateur::find($id);
        $utilisateur->delete();
    }

    public static function updateUtilisateur($id, $mail, $mdp, $admin)
    {
        $utilisateur = Utilisateur::find($id);
        $utilisateur->mail = $mail;
        $utilisateur->mdp = $mdp;
        $utilisateur->admin = $admin;
        $utilisateur->save();
        return $utilisateur;
    }
}