<?php

# Collectd Df plugin

require_once 'conf/common.inc.php';
require_once 'type/GenericStacked.class.php';
require_once 'inc/collectd.inc.php';

# LAYOUT
#
# curl-X/response_time.rrd

$obj = new Type_GenericStacked($CONFIG);
$obj->data_sources = array('value');

switch($obj->args['type']) {
	case 'response_time':
		$obj->rrd_title = sprintf('Response Time (%s)', $obj->args['pinstance']);
		$obj->rrd_vertical = 'Time';
		$obj->rrd_format = '%.1lf%s';
		break;
}

collectd_flush($obj->identifiers);
$obj->rrd_graph();
