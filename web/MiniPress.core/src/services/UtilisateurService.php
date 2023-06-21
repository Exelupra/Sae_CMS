<?php

namespace minipress\core\services;
use Illuminate\Database\Eloquent\Collection;
use minipress\core\models\Utilisateur;

class UtilisateurService
{

    public static function authenticate(string $email,
                                        string $passwd2check): bool {
        //on veut recuperer verifer l'utilisateur existe
        $utilisateur = Utilisateur::where('mail', $email)->first();
        if (!$utilisateur) {
            //si l'utilisateur n'existe pas on va sur la page d'inscription


            //on verifie que le mot de passe est bon
            return false;
        }
        $hash = $utilisateur->mdp;
        if (!password_verify($passwd2check, $hash)){return false;}
        //retourne true si l'utilisateur existe et que le mot de passe est bon

        $token = bin2hex(random_bytes(32));


        return true;
    }

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

    public static function createUtilisateur($id,$mail, $mdp)
    {
        $utilisateur = new Utilisateur();
        $utilisateur->id = $id;
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
            throw new AuthException(" error : invalid user email");

        $utilisateur->mail = $mail;
        $hash = password_hash($mdp, PASSWORD_DEFAULT, ['cost'=>12]);
        $utilisateur->mdp = $hash;
        $utilisateur->admin = false;
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