<?php

use Symfony\Component\HttpFoundation\Request;

class ServerController extends CRUDController
{
    public function listAction()
    {
        $servers = $this->getQueryBuilder()->getModels();

        return array("servers" => $servers);
    }

    public function showAction(Server $server, Player $me, Request $request)
    {
        if ($server->staleInfo()) {
            $server->forceUpdate();
        }

        if ($request->get('forced') && $me->canEdit($server)) {
            $server->forceUpdate();
        }

        return array("server" => $server);
    }

    public function createAction(Player $me)
    {
        return $this->create($me);
    }

    public function deleteAction(Player $me, Server $server)
    {
        return $this->delete($server, $me);
    }

    public function editAction(Player $me, Server $server)
    {
        return $this->edit($server, $me, "server");
    }
}
