<?php

namespace App\Http\Controllers\Setting;

use App\Models\User;
use App\Models\Zone;
use App\Models\Equipe;
use App\Models\Membre;
use App\Models\Reseau;
use App\Models\Partner;
use App\Models\Profile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

ini_set('memory_limit', '1024M');

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function indexCollaborateur()
    {
        $collaborateurs = Membre::orderby('created_at', 'desc')->with('zone', 'equipe', 'reseau')
        ->where('codepartenaire', 'LLV')->get();


        $reseaux = Reseau::where('codepartenaire', 'LLV')->get();
        $reseauId = $reseaux->pluck('id');

        $zones = Zone::whereIn('codereseau', $reseauId)->get();
        $zoneId = $zones->pluck('id');

        $equipes = Equipe::whereIn('codezone', $zoneId)->get();
        // dd($equipes->libelleequipe);

        $partners = Partner::where('code','LLV')->get();

        $roles = Role::all();
        
        $profiles = Profile::all();

        return view('settings.users.indexCollaborateur', compact('collaborateurs', 'reseaux', 'zones', 'equipes', 'partners', 'roles', 'profiles'));
    }
    public function index()
    {
        
        $membres = Membre::orderby('created_at', 'desc')
        ->where('typ_membre', '!=', '3')->where('codepartenaire','!=', 'llv')
        ->get()
        ->groupBy('codepartenaire');

        $reseaux = Reseau::all();
        $zones = Zone::all();
        $equipes = Equipe::all();
        $partners = Partner::all();
        $roles = Role::all();
        $profiles = Profile::all();
        
        return view('settings.users.index', compact('membres', 'reseaux', 'zones', 'equipes', 'partners', 'roles', 'profiles'));
    }

    public function indexByPartenaire($id)
    {
        $membresbypartenaire = Membre::orderby('idmembre', 'desc')->with('zone', 'equipe', 'reseau')
        ->where('codepartenaire', $id)->get();

        $reseaux = Reseau::all();
        $zones = Zone::all();
        $equipes = Equipe::all();
        $partners = Partner::all();
        $roles = Role::all();
        $profiles = Profile::all();
        $codepartenaire = $id;

        return view('settings.users.indexByPartner', compact('membresbypartenaire', 'reseaux', 'zones', 'equipes', 'partners', 'roles', 'codepartenaire', 'profiles'));
    }
    public function updateColumns(Request $request)
    {
        // Sauvegarde des colonnes dans la session
        $columns = $request->input('columns', []);
        session(['activeColumns' => $columns]);

        return redirect()->back()->with('success', 'Colonnes mises à jour avec succès.');
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        if ($request->codePart == "092") {
            $partenaire = "BNI";
            $type = null;
        } else {
            $partenaire = $request->codePart;
            $type = 2;
        }

        $id = now()->format('YmdHis') . Str::random(2);

        do {
            $id = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (Membre::where('idmembre', $id)->exists() && User::where('idmembre', $id)->exists());

        Log::info($id);

        switch ($request->profile_id) {
            case 5:
                $role = 'Conseiller';
                break;
            case 6:
                $role = 'Manager';
                break;
            case 7:
                $role = 'Responsable';
                break;
            case 8:
                $role = 'Superviseur';
                break;
            case 9:
                $role = 'Administrateur';
                break;
            default:
                $role = 'Inconnu';
                break;
        }

        Log::info($request->codeequipe);

        $agence = Equipe::select('codeequipe','libelleequipe','id')->where('codeequipe', $request->codeequipe)->first();
        
        log::info($agence);

        DB::beginTransaction();
        try {
            $membre = Membre::create([
                'idmembre' => $id,
                'codeagent' => $request->codeagent,
                'typ_membre' => $type,
                'codereseau' => $request->codereseau,
                'codepartenaire' => $request->codePart,
                'partenaire' => $partenaire,
                'codezone' => $request->codezone,
                'codeequipe' => $agence->id, // id agence // equipe
                'sexe' => $request->sexe,
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'datenaissance' => $request->datenaissance,
                'profession' => $request->profession,
                'agence' => $request->codeequipe,  // equipe es une aagence // code
                'nomagence' => $agence->libelleequipe,
                'branche' => $request->branche,
                'login' => $request->login,
                'role' => $role,
                'coderole' => $request->profile_id,
                'pass' => $request->pass,
                'email' => $request->email,
                'cel' => $request->cel,
                'tel' => $request->tel,
                'created_at' => now(),
                'created_by' => Auth::user()->membre->nom . ' ' . Auth::user()->membre->prenom,
            ])->save();

            if($membre){
                $user = User::create([
                    'idmembre' => $id,
                    'email' => $request->email,
                    'login' => $request->login,
                    'id_role' => $request->role_id,
                    'password' => bcrypt($request->pass),
                    'codepartenaire' => $request->codePart,
                    'branche' => $request->branche
                ]);

                $role = Role::find($request->role_id);
                $user->assignRole($role);
                $user->syncRoles([$role->id]);

                DB::commit();
            }

            $this->sendMail($request->email, $request->pass);

            DB::commit();

            if($membre){
                $dataResponse =[
                    'type'=>'success',
                    'urlback'=>"back",
                    'message'=>"Enregistré avec succes!",
                    'data'=>$membre,
                    'code'=>200,
                ];
                DB::commit();
            }else{
                $dataResponse =[
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Erreur d'enregistrement !",
                    'code'=>500,
                ];
                DB::rollBack();
            }
            

        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse =[
                'type'=>'error',
                'urlback'=>'',
                'message'=>"Erreur systeme! ". $th->getMessage(),
                'code'=>500,
            ];
        }
        return response()->json($dataResponse);
    }

    public function sendMail($email, $plainPassword)
    {
        
        $mailData = [
            'title' => 'Identifiant de connexion ! 🎉',
            'btnLink' => url('/'),
            'btnText' => 'Veuillez vous connecter pour finaliser',
            'body' => "
                <div style=\"font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto;\">
                                        <div style=\"background: linear-gradient(135deg, #076835 0%, #f7a400 100%); padding: 20px; border-radius: 10px 10px 0 0; text-align: center;\">
                        <h2 style=\"color: white; margin: 0; font-size: 24px;\">🎉 Bienvenue sur YNOV !</h2>
                        <p style=\"color: #e8f0fe; margin: 10px 0 0 0; font-size: 16px;\">Votre compte a été créé avec succès</p>
                    </div>
                    
                    <div style=\"background: white; padding: 30px; border: 1px solid #e0e0e0; border-top: none;\">
                        <p style=\"margin: 0 0 20px 0; font-size: 16px;\">Bonjour,</p>
                        
                        <p style=\"margin: 0 0 20px 0; font-size: 16px;\">
                            Félicitations ! Votre compte YNOV a été créé avec succès. Nous sommes ravis de vous accueillir dans notre communauté.
                        </p>
                        
                        <div style=\"background: #f8f9fa; border-left: 4px solid #1a73e8; padding: 20px; margin: 20px 0; border-radius: 0 8px 8px 0;\">
                            <h3 style=\"margin: 0 0 15px 0; color: #1a73e8; font-size: 18px;\">🔑 Vos identifiants de connexion</h3>
                            <div style=\"background: white; padding: 15px; border-radius: 8px; border: 1px solid #e0e0e0;\">
                                <p style=\"margin: 0 0 10px 0; font-size: 16px;\">
                                    <strong style=\"color: #1a73e8;\">📧 Email :</strong> 
                                    <span style=\"background: #f0f0f0; padding: 2px 6px; border-radius: 4px; font-family: monospace;\">{$email}</span>
                                </p>
                                <p style=\"margin: 0; font-size: 16px;\">
                                    <strong style=\"color: #1a73e8;\">🔐 Mot de passe :</strong> 
                                    <span style=\"background: #f0f0f0; padding: 2px 6px; border-radius: 4px; font-family: monospace;\">{$plainPassword}</span>
                                </p>
                            </div>
                        </div>
                        
                        <div style=\"background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; border-radius: 8px; margin: 20px 0;\">
                            <p style=\"margin: 0; font-size: 14px; color: #856404;\">
                                <strong>⚠️ Important :</strong> Pour des raisons de sécurité, nous vous recommandons fortement de changer votre mot de passe lors de votre première connexion.
                            </p>
                        </div>
                        
                        <p style=\"margin: 20px 0; font-size: 16px; text-align: center;\">
                            Cliquez sur le bouton ci-dessous pour vous connecter et finaliser votre inscription :
                        </p>
                        
                        <div style=\"text-align: center; margin: 30px 0;\">
                            <a href=\"" . url('/') . "\" style=\"
                                background: #076835;
                                color: white;
                                padding: 15px 30px;
                                text-decoration: none;
                                border-radius: 8px;
                                font-weight: bold;
                                font-size: 16px;
                                display: inline-block;
                                box-shadow: 0 4px 12px rgba(26, 115, 232, 0.3);
                                transition: all 0.3s ease;
                            \">
                                🚀 Se connecter maintenant
                            </a>
                        </div>
                        
                        <div style=\"background: #e8f5e8; border: 1px solid #c3e6c3; padding: 15px; border-radius: 8px; margin: 20px 0;\">
                            <p style=\"margin: 0; font-size: 14px; color: #155724;\">
                                <strong>💡 Astuce :</strong> Marquez cet email comme favori pour retrouver facilement vos identifiants si nécessaire.
                            </p>
                        </div>
                        
                        <hr style=\"border: none; border-top: 1px solid #e0e0e0; margin: 30px 0;\">
                        
                        <p style=\"margin: 20px 0 0 0; font-size: 16px;\">
                            Si vous avez des questions ou besoin d'assistance, notre équipe support est là pour vous aider. N'hésitez pas à nous contacter.
                        </p>
                        
                        <p style=\"margin: 20px 0 0 0; font-size: 16px;\">
                            Cordialement,<br>
                                                        <strong style=\"color: #076835;\">L'équipe YakoAfrica</strong> 🌍
                        </p>
                    </div>
                    
                    <div style=\"background: #f8f9fa; padding: 15px; border-radius: 0 0 10px 10px; text-align: center; border: 1px solid #e0e0e0; border-top: none;\">
                        <p style=\"margin: 0; font-size: 12px; color: #666;\">
                            © 2025 YAKOAFRICA - Tous droits réservés<br>
                            <span style=\"color: #999;\">Cet email a été envoyé automatiquement, merci de ne pas y répondre.</span>
                        </p>
                    </div>
                </div>
            "
        ];

        $emailSubject = 'Identifiant de connexion ! 🎉';

        Mail::send([], [], function ($message) use ($email, $emailSubject, $mailData) {
            $message->to($email)
                ->subject($emailSubject)
                ->html($mailData['body']);
        });

        // if (count(Mail::failures()) > 0) {
        //     return response()->json([
        //         'type' => 'error',
        //         'message' => "Échec de l'envoi du mail à cette adresse: " . implode(', ', Mail::failures()),
        //         'code' => 500,
        //     ]);
        // }

        return response()->json([
            'type' => 'success',
            'message' => "Mail envoyé avec succès!",
            'code' => 200,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // log::info($request->all());

        $membreUpdating = Membre::where('idmembre', $id)->first();

        switch ($request->profile_id) {
            case 5:
                $role = 'Conseiller';
                break;
            case 6:
                $role = 'Manager';
                break;
            case 7:
                $role = 'Responsable';
                break;
            case 8:
                $role = 'Superviseur';
                break;
            case 9:
                $role = 'Administrateur';
                break;
            default:
                $role = 'Inconnu';
                break;
        }


        Log::info("membreUpdating : $membreUpdating->codeequipe" );
        $agence = Equipe::where('codeequipe', $request->codeequipe)->first();
        
        Log::info("Agence : $agence" );

        DB::beginTransaction();

        try {
            $membre = Membre::where('idmembre', $id)->update([
                'codereseau' => $request->codereseau,
                'codezone' => $request->codezone,
                'codeequipe' => $agence->id,
                'sexe' => $request->sexe,
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'datenaissance' => $request->datenaissance,
                'profession' => $request->profession,
                'agence' => $agence->codeequipe,  // equipe es une aagence // code
                'nomagence' => $agence->libelleequipe,
                'branche' => $request->branche,
                'login' => $request->login,
                'role' => $role,
                'coderole' => $request->profile_id,
                // 'pass' => $request->pass,
                'email' => $request->email,
                'cel' => $request->cel,
                'tel' => $request->tel,
                'updated_at' => now(),
                'updated_by' => Auth::user()->membre->nom . ' ' . Auth::user()->membre->prenom,
            ]);

            if ($membre) {
                Log::info("Membre mis à jour");

                $userAssign = User::where('idmembre', $id)->first();

                Log::info("userAssign : $userAssign");
                if ($userAssign) {
                    Log::info("User assigné trouvé");

                    $userAssign->update([
                        'email' => $request->email,
                        'login' => $request->login,
                        'id_role' => $request->role_id,
                        'branche' => $request->branche
                    ]);

                    $role_id = Role::find($request->role_id);

                    Log::info("role : $role_id");
                    if ($role) {
                        $userAssign->assignRole($role_id);
                        $userAssign->syncRoles([$role_id->id]);
                        Log::info("Rôle synchronisé");
                    }
                }

                DB::commit();

                $dataResponse = [
                    'type' => 'success',
                    'urlback' => "back",
                    'message' => "Enregistré avec succès !",
                    'code' => 200,
                ];
            } else {
                DB::rollBack();
                $dataResponse = [
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Erreur d'enregistrement !",
                    'code' => 500,
                ];
            }

        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse = [
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur système ! " . $th->getMessage(),
                'code' => 500,
            ];
        }

        return response()->json($dataResponse);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        DB::beginTransaction();
        try {

            $saving= Membre::where(['idmembre'=>$id])->delete();

            $user = User::where(['idmembre'=>$id])->delete();

            if ($saving) {

                $dataResponse =[
                    'type'=>'success',
                    'urlback'=>"back",
                    'message'=>"Supprimé avec succes!",
                    'code'=>200,
                ];
                DB::commit();
            } else {
                DB::rollback();
                $dataResponse =[
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Erreur lors de la suppression!",
                    'code'=>500,
                ];
            }

        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse =[
                'type'=>'error',
                'urlback'=>'',
                'message'=>"Erreur systeme! $th",
                'code'=>500,
            ];
        }
        return response()->json($dataResponse);
    }


    public function userProfile()
    {
        return view('settings.users.profile.index');
    }
    public function updateProfile(Request $request, string $id)
    {
        // $user = TblUsers::where('idmembre', $id)->get();
        // dd($user);
        DB::beginTransaction();
        try {
            $user = Membre::where('idmembre', $id)->first();
            if($request->file('photo') == null){
                $imageName = Auth::user()->membre->photo;
            }else{
                $photoProfile = $request->file('photo');
                // dd($photoProfile);
                if ($photoProfile) {
                    $imageName = $user->idmembre .'_'.  now()->format('YmdHis'). '.' . $photoProfile->getClientOriginalExtension();
                    $destinationPath = public_path('images/userProfile');
                    $photoProfile->move($destinationPath, $imageName);   
                }
            }
            $user->update([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'cel' => $request->cel,
                'photo' => $imageName ?? '',           
            ]);
            if ($user) {
                $dataResponse = [
                    'type' => 'success',
                    'urlback' => "back",
                    'message' => "Modifié avec succès!",
                    'code' => 200,
                ];
                DB::commit();
            } else {
                DB::rollback();
                $dataResponse = [
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Erreur lors de la modification",
                    'code' => 500,
                ];
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse =[
                'type'=>'error',
                'urlback'=>'',
                'message'=>"Erreur systeme! $th",
                'code'=>500,
            ];
        }
        return response()->json($dataResponse);
    }

    public function updateMp(Request $request)
    {

        // dd($request->password);

        DB::beginTransaction();
        try {

            if ($request->password) {
                if ($request->password !== $request->confirm_password) {
                    DB::rollback();
                    $dataResponse = [
                        'type' => 'error',
                        'urlback' => '',
                        'message' => "Les mots de passe ne correspondent pas",
                        'code' => 400,
                    ];
                    return response()->json($dataResponse);
                }
                else{
                    $mp = auth()->user()->update([
                        'password' => bcrypt($request->password)
                    ]);

                    $id = auth()->user()->idmembre;
                    $membre = Membre::where('idmembre', $id)->firstOrFail();
                    if(!$membre){
                        $membre->update(['pass' => bcrypt($request->password)]);
                    }

                    if ($mp) {
                        // Déconnexion de l'utilisateur
                        auth()->logout();
    
                        $dataResponse = [
                            'type' => 'success',
                            'urlback' => "back",
                            'message' => "Modifié avec succès! Veuillez vous reconnecter avec votre nouveau mot de passe.",
                            'code' => 200,
                        ];
                        DB::commit();
                    } else {
                        DB::rollback();
                        $dataResponse = [
                            'type' => 'error',
                            'urlback' => '',
                            'message' => "Erreur lors de la modification",
                            'code' => 500,
                        ];
                    }
    

                }

            } else {
                $dataResponse = [
                    'type' => 'error',
                    'urlback' => 'back',
                    'message' => "Le mot de passe ne doit pas être vide",
                    'code' => 400,
                ];
            }

        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse =[
                'type'=>'error',
                'urlback'=>'',
                'message'=>"Erreur systeme! $th",
                'code'=>500,
            ];
        }
        return response()->json($dataResponse); 
    }
}
