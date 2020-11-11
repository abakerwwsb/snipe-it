<?php
namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\AssetRequest;
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
class AssetRacksController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }

    /**
     * Returns a view that finds all the racks from the custom fieldsets.
     *
     * @author [A. Baker]
     * @see AssetRacksController::getDatatable() method that generates the JSON response
     * @since [v1.0]
     * @return View
     */
    public function index(Request $request)
    {
        #$this->authorize('index', Asset::class);
        
        $racks = DB::select('select DISTINCT _snipeit_rack_number_18 FROM assets ORDER BY _snipeit_rack_number_18 ASC', [1]);

        return view('hardware/racks/index')->with('racks', $racks);
    }

  

    /**
     * Returns a view that presents information about an asset for detail view.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @param int $assetId
     * @since [v1.0]
     * @return View
     */
    public function show($rackId = null)
    {
        #$racks = DB::select('select * from assets where _snipeit_rack_number_18 = ' . $rackId, [1]);
        $racks = DB::table('models')
            ->join('assets', 'models.id', '=', 'assets.model_id')
            ->join('manufacturers', 'models.manufacturer_id', '=', 'manufacturers.id')
            ->select('assets.id as asset_id',
                     'assets.asset_tag',
                     'assets.name',
                     'assets.serial',
                     'assets.assigned_to',
                     'assets.notes',
                     'assets._snipeit_service_tag_2 as service_tag',
                     'assets._snipeit_computer_name_13 as computer_name',
                     'assets._snipeit_rack_number_18 as rack_number',
                     'assets._snipeit_ru_location_19 as ru_location',
                     'assets._snipeit_ru_size_20 as ru_size',
                     'models.name as model_name',
                     'models.model_number as model_number',
                     'manufacturers.name as manufacturer_name')
            ->where('_snipeit_rack_number_18', '=', $rackId)
            ->orderBy('assets._snipeit_ru_location_19', 'desc')
            ->get();

        return view('hardware/racks/show')->with('rackId', $rackId)->with('rackData', $racks);
    }

}
