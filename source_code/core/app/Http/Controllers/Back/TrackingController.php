<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Repositories\Back\TrackingRepository;
use App\Services\Tracking\TrackingManager;
use App\Services\Tracking\MetaCapiService;
use App\Services\Tracking\GA4MeasurementProtocolService;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    /**
     * @var TrackingRepository
     */
    protected $repository;

    /**
     * Constructor.
     *
     * @param TrackingRepository $repository
     */
    public function __construct(TrackingRepository $repository)
    {
        $this->middleware('auth:admin');
        $this->repository = $repository;
    }

    /**
     * Display the Tracking & Integrations tabbed dashboard.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $settings = $this->repository->getSettings();
        $customEvents = $this->repository->getCustomEvents();
        $platformStatuses = TrackingManager::getPlatformStatuses();
        $logs = $this->repository->getLogs($request);

        return view('back.tracking.index', compact('settings', 'customEvents', 'platformStatuses', 'logs'));
    }

    /**
     * Update tracking settings.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSettings(Request $request)
    {
        $this->repository->updateSettings($request->all());
        return redirect()->back()->withSuccess(__('Tracking & Integration settings updated successfully.'));
    }

    /**
     * Save (create/update) a custom tracking event rule.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function saveCustomEvent(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string|max:191',
            'trigger_type' => 'required|string',
            'trigger_target' => 'required|string|max:255',
            'destinations' => 'required|array|min:1',
        ]);

        $this->repository->saveCustomEvent($request->all(), $request->input('event_rule_id'));

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => __('Custom event rule saved successfully.')]);
        }

        return redirect()->route('back.tracking.index', ['tab' => 'event_builder'])->withSuccess(__('Custom event rule saved successfully.'));
    }

    /**
     * Delete a custom tracking event rule.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function deleteCustomEvent($id)
    {
        $this->repository->deleteCustomEvent($id);

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => __('Custom event rule deleted successfully.')]);
        }

        return redirect()->route('back.tracking.index', ['tab' => 'event_builder'])->withSuccess(__('Custom event rule deleted successfully.'));
    }

    /**
     * Toggle custom event active state.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleCustomEvent($id)
    {
        $event = $this->repository->toggleCustomEvent($id);
        return response()->json([
            'success' => true,
            'is_active' => $event->is_active,
            'message' => __('Event rule status toggled successfully.')
        ]);
    }

    /**
     * Test live Meta CAPI connection.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function testMetaConnection(Request $request)
    {
        $result = MetaCapiService::sendTestPing();
        return response()->json($result);
    }

    /**
     * Test live GA4 Measurement Protocol connection.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function testGA4Connection(Request $request)
    {
        $result = GA4MeasurementProtocolService::sendTestPing();
        return response()->json($result);
    }

    /**
     * Get paginated/filtered event logs for AJAX refresh.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLogs(Request $request)
    {
        $logs = $this->repository->getLogs($request);
        return response()->json([
            'html' => view('back.tracking.partials.log_rows', compact('logs'))->render(),
            'pagination' => (string)$logs->links()
        ]);
    }

    /**
     * Get raw details of a single event log.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLogDetails($id)
    {
        $log = $this->repository->getLogDetails($id);
        return response()->json([
            'id' => $log->id,
            'channel' => $log->channel,
            'event_name' => $log->event_name,
            'event_id' => $log->event_id,
            'http_status' => $log->http_status,
            'attempts' => $log->attempts,
            'payload' => $log->payload,
            'response_data' => $log->response_data,
            'created_at' => $log->created_at->format('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Retry dispatching a failed event log.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function retryLog($id)
    {
        $result = $this->repository->retryLog($id);
        return response()->json($result);
    }

    /**
     * Prune logs based on retention days.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pruneLogs(Request $request)
    {
        $days = $request->input('days', 30);
        $deleted = $this->repository->pruneLogs($days);
        return redirect()->route('back.tracking.index', ['tab' => 'logs'])
            ->withSuccess(__("Successfully pruned {$deleted} log entries."));
    }
}
