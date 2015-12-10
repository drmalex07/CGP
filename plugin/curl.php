<?php

# Collectd Df plugin

require_once 'conf/common.inc.php';
require_once 'type/Default.class.php';
require_once 'inc/collectd.inc.php';

# LAYOUT
#
# curl-X/response_time.rrd

$obj = new Type_Default($CONFIG);
$obj->data_sources = array('value');

switch($obj->args['type']) {
	case 'response_time':
		$obj->rrd_title = sprintf('%s', $obj->args['pinstance']);
		$obj->rrd_vertical = 'Response Time (s)';
		$obj->rrd_format = '%.1lf%s';
		break;
}

collectd_flush($obj->identifiers);
$obj->rrd_graph();
