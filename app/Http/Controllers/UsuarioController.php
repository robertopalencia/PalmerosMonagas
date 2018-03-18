<?php

namespace Palma\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Redirect;
use Palma\Http\Requests;
use Palma\Http\Controllers\Controller;
use DB;
use Palma\Productor;
use Palma\Banco;
use Palma\User;

use Illuminate\Support\Facades\Validator;
class UsuarioController extends Controller
{
    
      public function listadousers()
    { $request->user()->authorizeRoles(['admin']);
        return view ('users');    
    }
     
    public function vistaagregar()
    {
        return view ('uagregar');    
    }
    
    
    public function buscaruser (Request $request)
    {
        $sql = "SELECT * FROM users WHERE name='".$request->nombre."' 
            OR name LIKE '%".$request->nombre."%' 
             
            OR email LIKE '%".$request->nombre."%'";
             $resultado=$request->nombre;   
            $user=DB::select($sql);
            if(count($user)==0) 
            {   
             return view ('/users', ['user'=>$user, 'msj'=>'No se encontraron coincidencias con: ('.$request->nombre.")" ]);;
            }
            else
              {
                  return view ('/users', ['user'=>$user]);
              }
    } 
    
    public function agregarusuario(Request $request)
            {
                $validator = Validator::make($request->all(),
            [
                'name'=>'required | max:70',
                'password'=>'required|string|min:6|confirmed',
                'tipo'=>'required',
                'email'=>'required | email',
            ]);
                if($validator->fails()){
                 return redirect('/uagregar')
                     ->withInput()
                     ->withErrors($validator);
                }
                $userbd = User::all();
                $name=0;
                  foreach ($userbd as $users) {
                   
                    if ($request->name==$users->name){
                        $name=1;
                    }
                  }
                $email=0;
                foreach ($userbd as $users) {
                   
                    if ($request->email==$users->email){
                        $email=1;
                    }
                  }
                if($email==0 && $name==0) {
            $user=new User;
            $user->name = $request ->name;
            $user->password = bcrypt($request ->password);
            $user->type = $request ->type;
            $user->email = $request ->email;
            if($user->save()){
                return back()->with('msj', 'El usuario: '.$request->name.", ha sido guardado con exito"); 
            }
                }
                  else {
                    if($email==1){
                        if($name==1){
                            return back()->with('msj2', 'El Nombre de USUARIO: '.$request->name.'  y el Correo ELectronico: '.$request->email." YA EXISTEN");
                        }
                        else{
                           return back()->with('msj2', 'El Correo Electronico: '.$request->email." YA EXISTE"); 
                        }
                    }
                    else { if($name==1){
                        return back()->with('msj2', 'El nombre de USUARIO: '.$request->name." YA EXISTE"); 
                        
                    }
                          else{
                               return back()->with('msj2', 'Las contraseñas introducidas NO COINCIDEN');  
                          }
                         }
                }
                
                return redirect ('/');
            }
    public function tablausers()
    {
       $user= User::orderBy('name')->get();
            
            if (count($user)==0){
                return view('users', ['user'=>$user, 'msj'=>'NO HAY USUARIOS REGISTRADOS']);
            }
               else{ return view('users', ['user'=>$user]);}  
    }
    
    public function delete($id)
    {
    User::findOrFail($id)->delete();
    return redirect('/users');
    }
    
    public function update ($id, Request $request)
    {
         $validator = Validator::make($request->all(),
            [
                'name'=>'required | max:70',
                'password'=>'required|string|min:6|confirmed',
                'email'=>'required | email',
                
            ]);
                if($validator->fails()){
                      return redirect('/editarusuarios/'.$request->id)
                     ->withInput()
                     ->withErrors($validator);
                }
            $user=User::findOrFail($id);
            $user->name = $request ->name;
            $user->password = bcrypt($request ->password);
            $user->email = $request ->email;
            $user->save();
            return redirect('home');
    }
    
    public function viewupdate($id)
    {
          $users=User::findOrFail($id);
            return view('editarusuarios', ['users'=>$users]);
    }
}

