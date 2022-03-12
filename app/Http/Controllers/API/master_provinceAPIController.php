<?php

namespace App\Http\Controllers\API;

use Response;
use Illuminate\Http\Request;
use App\Models\master_province;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\AppBaseController;
use App\Repositories\master_provinceRepository;
use App\Http\Requests\API\Createmaster_provinceAPIRequest;
use App\Http\Requests\API\Updatemaster_provinceAPIRequest;

/**
 * Class master_provinceController
 * @package App\Http\Controllers\API
 */

class master_provinceAPIController extends AppBaseController
{
    /** @var  master_provinceRepository */
    private $masterProvinceRepository;

    public function __construct(master_provinceRepository $masterProvinceRepo)
    {
        $this->masterProvinceRepository = $masterProvinceRepo;
    }

    public function index(Request $request)
    {
        $masterProvinces = $this->masterProvinceRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );
        return ResponseFormatter::success(
            $masterProvinces,
            'Master Provinces retrieved successfully',
        );
    }

    public function store(Createmaster_provinceAPIRequest $request)
    {
        $input = $request->all();

        $masterProvince = $this->masterProvinceRepository->create($input);

        return ResponseFormatter::success(
            $masterProvince,
            'Master Province saved successfully',
        );
    }

    public function show($id)
    {
        /** @var master_province $masterProvince */
        $masterProvince = $this->masterProvinceRepository->find($id);

        if (empty($masterProvince)) {
            return $this->sendError('Master Province not found');
        }

        return $this->sendResponse($masterProvince->toArray(), 'Master Province retrieved successfully');
    }

    public function update($id, Updatemaster_provinceAPIRequest $request)
    {
        $input = $request->all();

        /** @var master_province $masterProvince */
        $masterProvince = $this->masterProvinceRepository->find($id);

        if (empty($masterProvince)) {
            return $this->sendError('Master Province not found');
        }

        $masterProvince = $this->masterProvinceRepository->update($input, $id);

        return $this->sendResponse($masterProvince->toArray(), 'master_province updated successfully');
    }

    public function destroy($id)
    {
        /** @var master_province $masterProvince */
        $masterProvince = $this->masterProvinceRepository->find($id);

        if (empty($masterProvince)) {
            return $this->sendError('Master Province not found');
        }

        $masterProvince->delete();

        return $this->sendSuccess('Master Province deleted successfully');
    }
}
