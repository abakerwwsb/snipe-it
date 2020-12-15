<?php
namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\AssetRequest;
use App\Models\Category as Category;
use App\Models\Actionlog;
use App\Models\Asset;
use App\Models\AssetModel;
use App\Models\CustomField;
use App\Models\Setting;
use App\Models\User;
use Artisan;
use Auth;
use Carbon\Carbon;
use Config;
use DB;
use Gate;
use Illuminate\Http\Request;
use Image;
use Input;
use Lang;
use Log;
use Paginator;
use Redirect;
use Response;
use Str;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use TCPDF;
use Validator;
use View;

/**
 * This class controls all actions related to assets for
 * the Snipe-IT Asset Management application.
 *
 * @version    v1.0
 * @author [A. Gianotto] [<snipe@snipe.net>]
 */
class AssetVehiclesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }

    /**
     * Returns a view that finds all the vehicles from the custom fieldsets.
     *
     * @author [A. Baker]
     * @see AssetVehiclesController::getDatatable() method that generates the JSON response
     * @since [v1.0]
     * @return View
     */
    public function index(Request $request)
    {
        #$vehicles = DB::select('select * from assets where _snipeit_rack_number_18 = ' . $rackId, [1]);
        $vehicles = DB::table('assets')
            ->join('models', 'assets.model_id', '=', 'models.id')
            ->leftJoin('users', 'assets.assigned_to', '=', 'users.id')
            ->leftJoin('status_labels', 'assets.status_id', '=', 'status_labels.id')
            ->select('assets.id as asset_id',
                     'assets.asset_tag',
                     'assets.name as asset_name',
                     'assets._snipeit_licence_plate_3 as license_plate',
                     'assets._snipeit_vin_number_4 as vin_number',
                     'assets._snipeit_vehicle_number_5 as vehicle_number',
                     'assets.assigned_to as asset_assigned_to',
                     'assets.notes as asset_notes',
                     'models.name as model_name',
                     'users.id as user_id',
                     'status_labels.name as status_name',
                     'users.id as user_id',
                     'users.first_name as user_first_name',
                     'users.last_name as user_last_name')
            ->whereRaw("_snipeit_licence_plate_3 <> '' AND status_labels.name <> 'Decomissioned'")
           
            ->orderBy('_snipeit_vehicle_number_5', 'asc')
            ->get();

        return view('hardware/vehicles/index')->with('vehicles', $vehicles);
    }

  

    /**
     * Returns a view that presents information about an asset for detail view.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @param int $assetId
     * @since [v1.0]
     * @return View
     */
    public function showAll($rackId = null)
    {
        #$vehicles = DB::select('select * from assets where _snipeit_rack_number_18 = ' . $rackId, [1]);
        $vehicles = DB::table('assets')
            ->join('models', 'assets.model_id', '=', 'models.id')
            ->leftJoin('users', 'assets.assigned_to', '=', 'users.id')
            ->leftJoin('status_labels', 'assets.status_id', '=', 'status_labels.id')
            ->select('assets.id as asset_id',
                     'assets.asset_tag',
                     'assets.name as asset_name',
                     'assets._snipeit_licence_plate_3 as license_plate',
                     'assets._snipeit_vin_number_4 as vin_number',
                     'assets._snipeit_vehicle_number_5 as vehicle_number',
                     'assets.assigned_to as asset_assigned_to',
                     'assets.notes as asset_notes',
                     'models.name as model_name',
                     'users.id as user_id',
                     'status_labels.name as status_name',
                     'users.id as user_id',
                     'users.first_name as user_first_name',
                     'users.last_name as user_last_name')
            ->whereRaw("_snipeit_licence_plate_3 <> ''")
           
            ->orderBy('_snipeit_vehicle_number_5', 'asc')
            ->get();

        return view('hardware/vehicles/showAll')->with('vehicles', $vehicles);
    }

}
