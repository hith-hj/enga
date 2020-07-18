<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\userFeats;
use App\userRanks;
use Storage;
use Auth;
use DB;

class HomeController extends Controller
{
    protected $users;
    protected $feats = [];
    protected $keys = [];
    protected $fina = [];
    protected $matche = [];
    protected $matchPercent;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->status == 0){
            return view('adds.first');
        }else {
            userRanks::checkFull(); 
            $type = 'body';
            return view('index',compact('type'));
        }
        
    }

    public function router($type)
    {  
        dd($type);  
        return view('index',compact('type'));
    }

    public function first(Request $req)
    {
        $this->validate($req,[
            'gender'=>'required',
            'education'=>'required',
            'district'=>'required',
            'age'=>'required|max:90',
        ]);
        $user = User::find(Auth::user()->id);
        $user->gender = $req->gender;
        $user->phone = $req->phone;
        $user->age = $req->age;
        $user->district = $req->district;
        $user->education = $req->education;
        $user->socialStatus = $req->socialStatus;
        $user->save();
        
        // return view('second');
        return redirect()->route('userFeats');
    }

    public function second(Request $req)
    {
        $this->validate($req,[
            'user_image' => 'nullable|image|max:1999',
        ]);
        $image = $req->file('user_image');
        if($req->hasFile('user_image') && $image->isFile()){
            $nameWithExt = $image->getClientOriginalName();
            $fileName = pathinfo($nameWithExt,PATHINFO_FILENAME);
            $ext = $image->getClientOriginalExtension();
            $currentDate = Carbon::now()->toDateString();            
            $nameToStore = $fileName.'_'.$currentDate.'.'.$ext;
            if(!Storage::disk('public')->exists('users_images')){
                Storage::disk('public')->makeDirectory('users_images');
            }
            $path = $image->storeAs('public/users_images',$nameToStore);
        } else {
            $nameToStore = 'user.jpg';
        } 
        $info = $req->all();
        $user = User::find(Auth::user()->id);
        $user->user_image = $nameToStore;        
        $user->bio = $info['bio'];
        $user->status = 1;
        $user->save();
        $infos = \array_slice($info,0,21);
        return $this->storeFeats($infos);
    }

    public function storeFeats(Array $data)
    {
        // dd($data);  
        $stackRank=null;
        $stackSum=0;
        $user = new userFeats();
        $user->user_id = Auth::user()->id;
        foreach($data as $key => $value)
        {
            $str = \explode('/',$value);
            // dd($str);
            $stackRank .= $str[1];
            $stackSum += $str[1];
            $user->$key = $str[0]; 
        }
        $user->save();
        $rank = new userRanks();
        $rank->user_id = Auth::user()->id;
        $rank->stackRank = $stackRank;
        $rank->stackSum = $stackSum;
        $rank->save();
        return redirect()->route('getUsers');
    }

    public function third(Request $req)
    {
        return view('forth');
    }

    public function getIds(Request $req)
    {
        $ids = $req->ids;
        // dd($ids);
        $this->matchPercent = $req->matchPercent;
        $ids = explode(',',$ids);
        $this->users = User::find($ids);
        
        $this->getUsersFeats();

        $this->gatherUsersFeats();

        $this->buildFeatsArray();

        $this->matchFeatsRank();

        $this->getMatch();

        return $this->goFourth();
                      
    }

    protected function getUsersFeats()
    {
        $users = $this->users;
        foreach($users as $user)
        {
            $senduser = $user;
            $usr=[];
            $user = \collect($user);
            foreach($user as $key => $val)
            {
                $usr[$key]=$val;                               
                $this->keys[$key] = array();                        
            }
            $usr = \array_slice($usr,7,24,true);
            $rank = $this->calcRank($senduser,array_keys($this->keys));            
            foreach($usr as $key => $val)
            {
                $usr[$key]=$val.'/'.$rank[$key];                        
            }
            $this->feats[] = $usr;
        }
        return ;
    }

    protected function calcRank($user,$arr)
    {
        $array = \array_slice($arr,7,24,true);
        $rank1 = \str_split($user->stackRank);
        $rank2 = \array_combine($array,$rank1);

        return $rank2;
    }

    protected function gatherUsersFeats()
    {
        $this->keys = \array_slice($this->keys,7,24,true);
        
        foreach($this->feats as $feat )
        {
            foreach($feat as $fkey => $fval)
            {
                \array_push($this->keys[$fkey],$fval);
            }
        }
        return;
    }

    protected function buildFeatsArray()
    {
        foreach($this->keys as $key => $val)
        {
            $count = \array_count_values($val);
            $max = array_search(max($count),$count);
            $this->fina[$key] = $max;
        }
        return;
    }

    protected function matchFeatsRank()
    {
        $match = $this->fina;
        $stackRank=null;
        $sumRank=0;
        // dd($match);
        foreach($match as $mat)
        {
            $m1 = \explode('/',$mat);
            $stackRank .= $m1[1]; 
            $sumRank += $m1[1];    
        }
        $this->fina['stackRank'] = $stackRank;
        $this->fina['sumRank'] = $sumRank;

        $us = User::find(Auth::user()->id);
        $us->semiRank = $stackRank;
        $us->semiSum = $sumRank;
        $us->save();
        return ;
    }

    protected function getMatch()
    {      
        $sumR = $this->fina['sumRank'];
        $stackR = $this->fina['sumRank'];
        $var = 1;   
        $matches = [];
        $fuck = [];
        
        while(count($matches)<3){
            $var++;
            $one = $sumR-$var;
            $two = $stackR+$var;
            $three = Auth::user()->stackSum + $var;
            $four = Auth::user()->stackSum - $var;
            $matches = DB::table('users')->whereBetween('stackSum',[$one , $two])->whereBetWeen('semiSum',[$four,$three])->get()->toArray();                      
        }       

        $matches = array_filter($matches,function($match){
            Auth::user()->gender == 'male' ? $gen = 'female' : $gen = 'male';
            return $match->gender == $gen ? $match : NULL ;
        });
        return $this->findMatch($matches);      
    }

    private function findMatch($matches)
    {
        $finaStackRArr = str_split($this->fina['stackRank']);
        foreach($matches as $match){
            $a1 = array_map(function($a,$b){
                return $a == $b ? 1 : 0 ;
            },str_split($match->stackRank),$finaStackRArr);
            $count = count(array_keys($a1, "1"));
            if($count >= $this->matchPercent)
            {
                $this->matche[$match->id] = $count;
            }
        }
        return;
    }

    public function goFourth()
    {
        $ids = [];
        foreach($this->matche as $key => $val)
        {
            $ids[$key] = User::find($key);
        }
        foreach($ids as $id)
        {
            $id->matchRate = round($this->matche[$id->id]*100/24, 3);
        }
        $ids = \collect($ids);
        $fina = (object) $this->fina;
        $per = $this->matchPercent;
        return view('forth',compact('fina','ids','per'));
    }
    
    public function csv()
    {
        $file = fopen('dts1.csv','w');
        $text = 'gender'.','.'stRank'.','.'sumRank'.','.'reqStRank'.','.'reqSumRank'.PHP_EOL;
        fwrite($file,$text);        
        for($i=0;$i<1000;$i++)
        {
            $stRank = null ; $sumRank = 0;
            $reqStRank = null ;$reqSumRank = 0;
            $gen = rand(0,1);
            for($j=0;$j<24;$j++)
            {
                $rank = rand(1,5);
                $stRank .= $rank;
                $sumRank += $rank;
                $req = $this->reqRank($rank);
                $reqStRank .= $req;
                $reqSumRank += $req;                
            }
            $row = $gen.','.$stRank.','.$sumRank.','.$reqStRank.','.$reqSumRank.PHP_EOL;
            \fwrite($file,$row);   
        }    
        \fclose($file);
    }
    public function csv2()
    {
        $file = fopen('t5.csv','w');
        $text = 'gender'.','.'stRank'.','.'reqStRank'.PHP_EOL;
        fwrite($file,$text);        
        for($i=0;$i<1000;$i++)
        {
            $stRank = null ; $sumRank = 0;
            $reqStRank = null ;$reqSumRank = 0;
            $gen = rand(0,1);
            for($j=0;$j<24;$j++)
            {
                $rank = rand(1,5);
                $stRank .= $rank;
                $sumRank += $rank;
                $req = $this->reqRank($rank);
                $reqStRank .= $req;
                $reqSumRank += $req;                
            }
            $row = $gen.','.$stRank.','.$reqStRank.PHP_EOL;
            \fwrite($file,$row);   
        }    
        \fclose($file);
    }

    private function reqRank($ran)
    {
        switch($ran){
            case 5:
                $rnd = rand(0,1);
                return $ran-$rnd;
            break;
            case 1:
                $rnd = rand(0,2);
                return $ran+$rnd;
            break;
            default:
                $rnd = rand(0,1);
                return $ran+$rnd;
            break;
        }
    } 

    public function newRank($type)
    {
        $first = app('Trainer')->scorer(Auth::user()->stackRank);
        // $predict = app('Trainer')->predicte(Auth::user()->stackRank , $first);
        return \back()->with('first');
    }

    public function stockRef(Request $req)
    {
        $stockRank = NULL;
        $stockSum = 0;
        $info = $req->all();
        unset($info['_token']);
        foreach($info as $key => $val){
            $val = \explode('/',$val);
            $stockRank .= $val[1];
            $stockSum += $val[1];
        }
        $up = userRanks::find(Auth::id());
        $up->stockRank = $stockRank;
        $up->stockSum = $stockSum;
        $up->save(); 
        return \redirect()->route('home');
    }

    public function feats()
    {
        $feat=['Height'=>['155-160','160-165','165-170','170-175','175-180','180-185','185-190','190-195',],
                'Weight'=>['55-60','60-65','65-70','70-75','75-80','80-85','85-90','90-95',],
                'Skin Color'=>['White','Brunette','Dark','skin4','skin5',],
                'Eyes Color'=>['Brown','Blue','Green','Dark','eyes4','eyes5'],
                'Hair Color'=>['Red','Burnette','Blond','Dark','hair4','h5'],
                'Hair Length'=>['Bald','Short','Medium','Long','Very Long','hr5'],
                'Face Shape'=>['Oval','Round','A-triangle','V-triangle','Diamond','f5'],
                'Eyes Size'=>['Small','Normall','Big','e1','e2','e3'],
                'Mouth Size'=>['Slim','Normal','Full','Wide','Big','M5'],
                'Chin Shape'=>['Narrow','Normal','Wide','c1','c2','c3'],
                'Hair type'=>['Light','Normal','Heavy','h1','h2','h3'],
                'Body Type'=>['Slim','Normal','Curvy','Chubby','b1','b2'],
                'Body Shape'=>['Round','Hour glass','Rectangle','V-triangle','A-triangle',],
                'waist Line'=>['Xsmall','Small','Medium','Large','XLarge',],
                'Muscles Rate'=>['Xsmall','Small','Medium','Large','XLarge','M5'],
                'Beard Type'=>['Light','Normall','Heavy','Large','XLarge','B5'],
            ];
        $sFeat = serialize($feat);    
        file_put_contents('store', $sFeat);
        dd('done',$feat);
    }
}
