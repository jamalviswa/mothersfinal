<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Rules\Mobile;
use App\Rules\Email;
use Session;
use DB;
use Redirect;
use App\Phase;
use App\Block;
use App\Floor;
use App\Flattype;
use App\Flatnumber;

class MastersController extends Controller
{

    //Phase 

    public function phase_index()
    {
        $sessionadmin = Parent::checkadmin();
        $result = Phase::where('status', '<>', 'Trash')->orderBy('phase_id', 'desc');
        if (!empty($_REQUEST['s'])) {
            $s = $_REQUEST['s'];
            $result->where(function ($query) use ($s) {
                $query->where('phase_name', 'LIKE', "%$s%");
            });
        }
        $result = $result->paginate(10);
        return view('/masters/phase_index', [
            'results' => $result
        ]);
    }

    public function phase_add()
    {
        $sessionadmin = Parent::checkadmin();
        return view('masters/phase_add', []);
    }

    public function phase_store(Request $request)
    {
        $sessionadmin = Parent::checkadmin();
        $check = $this->validate($request, [
            'phase_name' => ['required', Rule::unique('phases')->where(function ($query) use ($request) {
                return $query->where('phase_name', $request->phase_name)->where('status', '<>', 'Trash');
            })],
        ]);
        $data = new Phase();
        $data->phase_name = $request->phase_name;
        $data->created_date = date('Y-m-d H:i:s');
        $data->status = "Active";
        $data->save();
        Session::flash('message', 'Phase Added!');
        Session::flash('alert-class', 'success');
        return \Redirect::route('masters.phase_index', []);
    }

    public function phase_edit($id = null)
    {
        $sessionadmin = Parent::checkadmin();
        $detail = Phase::where('phase_id', '=', $id)->first();
        return view('masters/phase_edit', ['detail' => $detail]);
    }

    public function phase_update(Request $request, $id = null)
    {
        $check = $this->validate($request, [
            'phase_name' => ['required', Rule::unique('phases')->where(function ($query) use ($request, $id) {
                return $query->where('phase_name', $request->phase_name)->where('phase_id', '<>', $id)->where('status', '<>', 'Trash');
            })],
        ]);
        $data = Phase::findOrFail($id);
        $data->phase_name = $request->phase_name;
        $data->modified_date = date('Y-m-d H:i:s');
        $data->save();
        Session::flash('message', 'Phase Updated!');
        Session::flash('alert-class', 'success');
        return \Redirect::route('masters.phase_index', []);
    }

    //Block 

    public function block_index()
    {
        $sessionadmin = Parent::checkadmin();
        $result = Block::where('status', '<>', 'Trash')->orderBy('block_id', 'desc');
        if (!empty($_REQUEST['s'])) {
            $s = $_REQUEST['s'];
            $result->where(function ($query) use ($s) {
                $query->where('block_name', 'LIKE', "%$s%");
            });
        }
        if (!empty($_REQUEST['phase'])) {
            $phase = $_REQUEST['phase'];
            $result->where(function ($query) use ($phase) {
                $query->where('phase_id', 'LIKE', "%$phase%");
            });
        }
        $result = $result->paginate(10);
        return view('/masters/block_index', [
            'results' => $result
        ]);
    }

    public function block_add()
    {
        $sessionadmin = Parent::checkadmin();
        return view('masters/block_add', []);
    }

    public function block_store(Request $request)
    {
        $sessionadmin = Parent::checkadmin();
        $check = $this->validate($request, [
            'phase' => ['required'],
            'block_name' => ['required', Rule::unique('blocks')->where(function ($query) use ($request) {
                return $query->where('block_name', $request->block_name)->where('status', '<>', 'Trash');
            })],
        ]);
        $data = new Block();
        $data->phase_id = $request->phase;
        $data->block_name = $request->block_name;
        $data->created_date = date('Y-m-d H:i:s');
        $data->status = "Active";
        $data->save();
        Session::flash('message', 'Block Added!');
        Session::flash('alert-class', 'success');
        return \Redirect::route('masters.block_index', []);
    }

    public function block_edit($id = null)
    {
        $sessionadmin = Parent::checkadmin();
        $detail = Block::where('block_id', '=', $id)->first();
        return view('masters/block_edit', ['detail' => $detail]);
    }

    public function block_update(Request $request, $id = null)
    {
        $check = $this->validate($request, [
            'phase' => ['required'],
            'block_name' => ['required', Rule::unique('blocks')->where(function ($query) use ($request, $id) {
                return $query->where('block_name', $request->block_name)->where('block_id', '<>', $id)->where('status', '<>', 'Trash');
            })],
        ]);
        $data = Block::findOrFail($id);
        $data->phase_id = $request->phase;
        $data->block_name = $request->block_name;
        $data->modified_date = date('Y-m-d H:i:s');
        $data->save();
        Session::flash('message', 'Block Updated!');
        Session::flash('alert-class', 'success');
        return \Redirect::route('masters.block_index', []);
    }

    //Floor 

    public function floor_index()
    {
        $sessionadmin = Parent::checkadmin();
        $result = Floor::where('status', '<>', 'Trash')->orderBy('floor_id', 'desc');
        if (!empty($_REQUEST['s'])) {
            $s = $_REQUEST['s'];
            $result->where(function ($query) use ($s) {
                $query->where('floor_name', 'LIKE', "%$s%");
            });
        }
        if (!empty($_REQUEST['phase'])) {
            $phase = $_REQUEST['phase'];
            $result->where(function ($query) use ($phase) {
                $query->where('phase', 'LIKE', "%$phase%");
            });
        }
        if (!empty($_REQUEST['block'])) {
            $block = $_REQUEST['block'];
            $result->where(function ($query) use ($block) {
                $query->where('block', 'LIKE', "%$block%");
            });
        }
        $result = $result->paginate(10);
        return view('/masters/floor_index', [
            'results' => $result
        ]);
    }

    public function floor_add()
    {
        $sessionadmin = Parent::checkadmin();
        return view('masters/floor_add', []);
    }

    public function floor_store(Request $request)
    {
        $sessionadmin = Parent::checkadmin();
        $check = $this->validate($request, [
            'phase' => ['required'],
            'block' => ['required'],
            'floor_name'=> ['required'],
        ]);
        $data = new Floor();
        $data->phase = $request->phase;
        $data->block = $request->block;
        $data->floor_name = $request->floor_name;
        $data->created_date = date('Y-m-d H:i:s');
        $data->status = "Active";
        $data->save();
        Session::flash('message', 'Floor Added!');
        Session::flash('alert-class', 'success');
        return \Redirect::route('masters.floor_index', []);
    }

    public function floor_edit($id = null)
    {
        $sessionadmin = Parent::checkadmin();
        $detail = Floor::where('floor_id', '=', $id)->first();
        return view('masters/floor_edit', ['detail' => $detail]);
    }

    public function floor_update(Request $request, $id = null)
    {
        $check = $this->validate($request, [
            'phase' => ['required'],
            'block' => ['required'],
            'floor_name'=> ['required'],
        ]);
        $data = Floor::findOrFail($id);
        $data->phase = $request->phase;
        $data->block = $request->block;
        $data->floor_name = $request->floor_name;
        $data->modified_date = date('Y-m-d H:i:s');
        $data->save();
        Session::flash('message', 'Floor Updated!');
        Session::flash('alert-class', 'success');
        return \Redirect::route('masters.floor_index', []);
    }

    //Flat Type 

    public function flattype_index()
    {
        $sessionadmin = Parent::checkadmin();
        $result = Flattype::where('status', '<>', 'Trash')->orderBy('flattype_id', 'desc');
        if (!empty($_REQUEST['s'])) {
            $s = $_REQUEST['s'];
            $result->where(function ($query) use ($s) {
                $query->where('flattype_name', 'LIKE', "%$s%");
            });
        }
        if (!empty($_REQUEST['phase'])) {
            $phase = $_REQUEST['phase'];
            $result->where(function ($query) use ($phase) {
                $query->where('phase', 'LIKE', "%$phase%");
            });
        }
        if (!empty($_REQUEST['block'])) {
            $block = $_REQUEST['block'];
            $result->where(function ($query) use ($block) {
                $query->where('block', 'LIKE', "%$block%");
            });
        }
        // if (!empty($_REQUEST['floor'])) {
        //     $floor = $_REQUEST['floor'];
        //     $result->where(function ($query) use ($floor) {
        //         $query->where('floor', 'LIKE', "%$floor%");
        //     });
        // }
        $result = $result->paginate(10);
        return view('/masters/flattype_index', [
            'results' => $result
        ]);
    }

    public function flattype_add()
    {
        $sessionadmin = Parent::checkadmin();
        return view('masters/flattype_add', []);
    }

    public function flattype_store(Request $request)
    {
        $sessionadmin = Parent::checkadmin();
        $check = $this->validate($request, [
            'phase' => ['required'],
            'block' => ['required'],
            'floor'=> ['required'],
            'flattype'=> ['required'],
        ]);
        $data = new Flattype();
        $data->phase = $request->phase;
        $data->block = $request->block;
        $data->floor = $request->floor;
        $data->flattype = $request->flattype;
        $data->created_date = date('Y-m-d H:i:s');
        $data->status = "Active";
        $data->save();
        Session::flash('message', 'Flat Type Added!');
        Session::flash('alert-class', 'success');
        return \Redirect::route('masters.flattype_index', []);
    }

    public function flattype_edit($id = null)
    {
        $sessionadmin = Parent::checkadmin();
        $detail = Flattype::where('flattype_id', '=', $id)->first();
        return view('masters/flattype_edit', ['detail' => $detail]);
    }

    public function flattype_update(Request $request, $id = null)
    {
        $check = $this->validate($request, [
            'phase' => ['required'],
            'block' => ['required'],
            'floor'=> ['required'],
            'flattype'=> ['required'],
        ]);
        $data = Flattype::findOrFail($id);
        $data->phase = $request->phase;
        $data->block = $request->block;
        $data->floor = $request->floor;
        $data->flattype = $request->flattype;
        $data->modified_date = date('Y-m-d H:i:s');
        $data->save();
        Session::flash('message', 'Flat Type Updated!');
        Session::flash('alert-class', 'success');
        return \Redirect::route('masters.flattype_index', []);
    }

    //Flat Number 

    public function flatnumber_index()
    {
        $sessionadmin = Parent::checkadmin();
        $result = Flatnumber::where('status', '<>', 'Trash')->orderBy('flatnumber_id', 'desc');
        if (!empty($_REQUEST['s'])) {
            $s = $_REQUEST['s'];
            $result->where(function ($query) use ($s) {
                $query->where('flatnumber', 'LIKE', "%$s%");
            });
        }
        if (!empty($_REQUEST['phase'])) {
            $phase = $_REQUEST['phase'];
            $result->where(function ($query) use ($phase) {
                $query->where('phase', 'LIKE', "%$phase%");
            });
        }
        if (!empty($_REQUEST['block'])) {
            $block = $_REQUEST['block'];
            $result->where(function ($query) use ($block) {
                $query->where('block', 'LIKE', "%$block%");
            });
        }
        // if (!empty($_REQUEST['floor'])) {
        //     $floor = $_REQUEST['floor'];
        //     $result->where(function ($query) use ($floor) {
        //         $query->where('floor_id', 'LIKE', "%$floor%");
        //     });
        // }
        // if (!empty($_REQUEST['flattype'])) {
        //     $flattype = $_REQUEST['flattype'];
        //     $result->where(function ($query) use ($flattype) {
        //         $query->where('flattype_id', 'LIKE', "%$flattype%");
        //     });
        // }
        $result = $result->paginate(10);
        return view('/masters/flatnumber_index', [
            'results' => $result
        ]);
    }

    public function flatnumber_add()
    {
        $sessionadmin = Parent::checkadmin();
        return view('masters/flatnumber_add', []);
    }
    public function flatnumber_store(Request $request)
    {
        $sessionadmin = Parent::checkadmin();
        $check = $this->validate($request, [
            'phase' => ['required'],
            'block' => ['required'],
            'floor' => ['required'],
            'flattype' => ['required'],
            'flatnumber' => ['required'],
        ]);
        $data = new Flatnumber();
        $data->phase = $request->phase;
        $data->block = $request->block;
        $data->floor = $request->floor;
        $data->flattype = $request->flattype;
        $data->flatnumber = $request->flatnumber;
        $data->created_date = date('Y-m-d H:i:s');
        $data->status = "Active";
        $data->save();
        Session::flash('message', 'Flat Number  Added!');
        Session::flash('alert-class', 'success');
        return \Redirect::route('masters.flatnumber_index', []);
    }

    public function flatnumber_edit($id = null)
    {
        $sessionadmin = Parent::checkadmin();
        $detail = Flatnumber::where('flatnumber_id', '=', $id)->first();
        return view('masters/flatnumber_edit', ['detail' => $detail]);
    }
    public function flatnumber_update(Request $request, $id = null)
    {
        $check = $this->validate($request, [
            'phase' => ['required'],
            'block' => ['required'],
            'floor' => ['required'],
            'flattype' => ['required'],
            'flatnumber' => ['required'],
          
        ]);
        $data = Flatnumber::findOrFail($id);
        $data->phase = $request->phase;
        $data->block = $request->block;
        $data->floor = $request->floor;
        $data->flattype = $request->flattype;
        $data->flatnumber = $request->flatnumber;
        $data->modified_date = date('Y-m-d H:i:s');
        $data->save();
        Session::flash('message', 'Flat Number Updated!');
        Session::flash('alert-class', 'success');
        return \Redirect::route('masters.flatnumber_index', []);
    }

    public function map(Request $request)
    {
        if (!empty($_REQUEST['phase'])) {
            $id = $_REQUEST['phase'];
            $blocks = Block::where('phase_id', $id)->get();
            echo '<option value="">Select Block</option>';
            foreach ($blocks as $block) {
                echo '<option value="' . $block->block_id . '">' . $block->block_name . '</option>';
            }
            exit;
        } else  if (!empty($_REQUEST['block'])) {
            $id = $_REQUEST['block'];
            $floors = Floor::where('block', $id)->get();
            echo '<option value="">Select Floor</option>';
            foreach ($floors as $floor) {
                echo '<option value="' . $floor->floor_id . '">' . $floor->floor_name . '</option>';
            }
            exit;
        } else  if (!empty($_REQUEST['floor'])) {
            $id = $_REQUEST['floor'];
            $flattypes = Flattype::where('floor', $id)->get();
            echo '<option value="">Select Flat Type</option>';
            foreach ($flattypes as $flattype) {
                echo '<option value="' . $flattype->flattype_id . '">' . $flattype->flattype . '</option>';
            }
            exit;
        }
    }
}
