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
class AssetBarcodesController extends Controller
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
        

        return view('hardware/barcodes/index');
    }

  

    /**
     * Returns a view that presents information about an asset for detail view.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @param int $assetId
     * @since [v1.0]
     * @return View
     */
    public function create(Request $request)
    {
        #dd($request->all());
        
        try {
            $admin = Auth::user();

            //$target = $this->determineCheckinTarget();

            if (!is_array($request->get('selected_assets'))) {
                return redirect()->route('index/barcodes')->withInput()->with('error', trans('admin/hardware/message.checkout.no_assets_selected'));
            }

            $asset_ids = array_filter($request->get('selected_assets'));

            $errors = [];
            $barcode_list = "";

                foreach ($asset_ids as $asset_id) {
                    $asset = Asset::findOrFail($asset_id);
                    
                    $barcode_list .= $asset_id.', ';

                }
                #$barcode_list .= 1;

                $barcodes = DB::table('assets')
                    ->join('models', 'assets.model_id', '=', 'models.id')
                    ->leftJoin('status_labels', 'assets.status_id', '=', 'status_labels.id')
                    ->leftJoin('manufacturers', 'models.manufacturer_id', '=', 'manufacturers.id')
                    ->select('assets.id as asset_id',
                            'assets.asset_tag',
                            'assets.name as asset_name',
                            'assets.serial as asset_serial',
                            'assets.notes as asset_notes',
                            'models.name as model_name',
                            'manufacturers.name as manufacturer_name',
                            'models.model_number as model_model_number',
                            'status_labels.name as status_name')
                    #->whereRaw(" assets.id IN ('". $barcode_list."')")
                    ->whereIn("assets.id", $asset_ids)

                    ->get();


            if (!$errors) {
                // Redirect to the barcode page
                return view('hardware/barcodes/create')->with('barcodes', $barcodes)->with('request', $request);
            }
            // Redirect to the asset management page with error
            return redirect()->to("index/barcodes")->with('error', trans('admin/hardware/message.checkin.error'))->withErrors($errors);
        } catch (ModelNotFoundException $e) {
            return redirect()->to("index/barcodes")->with('error', $e->getErrors());
        }

        

        #return view('hardware/barcodes/create')->with('vehicles', $vehicles);
    }

}
