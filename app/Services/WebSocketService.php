<?php

namespace App\Services;

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;
use Illuminate\Support\Facades\Log;
use Hhxsv5\LaravelS\Swoole\WebSocketHandlerInterface;

/**
 * @see https://www.swoole.co.uk/docs/modules/swoole-websocket-server
 */
class WebSocketService implements WebSocketHandlerInterface
{
	// Declare constructor without parameters
	public function __construct()
	{
	}

	public function onOpen(Server $server, Request $request)
	{
		Log::info('New WebSocket connection', [$request->fd, request()->all(), session()->getId()]);
		$server->push($request->fd, 'Welcome to LaravelS');
	}
	public function onMessage(Server $server, Frame $frame)
	{

		Log::info('Received message', [$frame->fd, $frame->data, $frame->opcode, $frame->finish]);
		$server->push($frame->fd, $frame->fd . date('Y-m-d H:i:s'));
	}
	public function onClose(Server $server, $fd, $reactorId)
	{
		// The exceptions thrown here will be caught by the upper layer and recorded in the Swoole log. Developers need to try/catch manually.
	}
}