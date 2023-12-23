<?php

include ('../../config/config.inc.php');

//ini_set('display_errors','1');
//error_reporting(E_ALL);
function mres($value) {
    $search = array("\\", "\x00", "\n", "\r", "'", '"', "\x1a");
    $replace = array("\\\\", "\\0", "\\n", "\\r", "\'", '\"', "\\Z");
    return str_replace($search, $replace, $value);
}

if ($_REQUEST['types'] == 'billtable') {
    $aColumns = array('id', 'type', 'prefix', 'current_value');
    $sIndexColumn = "id";
    $editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbill" : "editbill";
    $sTable = "bill_settings";
}

if ($_REQUEST['types'] == 'objecttable') {
    $aColumns = array('id', 'objectname');
    $sIndexColumn = "id";
    $editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbill" : "editbill";
    $sTable = "object";
}

if ($_REQUEST['types'] == 'silverobjecttable') {
    $aColumns = array('id', 'objectname');
    $sIndexColumn = "id";
    $editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbill" : "editbill";
    $sTable = "silverobject";
}
if ($_REQUEST['types'] == 'returntable') {
    $aColumns = array('id', 'date','currentdate', 'customeridname','receipt_no', 'status');
    $sIndexColumn = "id";
    // $editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbill" : "editbill";
    $sTable = "`return`";
}


if ($_REQUEST['types'] == 'financecustomertbale') {
    $aColumns = array('id', 'cusid', 'name', 'mobileno');
    $sIndexColumn = "id";
    $editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbill" : "editbill";
    $sTable = "customer";
}

if ($_REQUEST['types'] == 'loantable') {
    $aColumns = array('id', 'date','customerid', 'receipt_no','amount', 'mobileno');
    $sIndexColumn = "id";
    $editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbill" : "editbill";
    $sTable = "loan";
}


if ($_REQUEST['types'] == 'bankstatustable') {
    $aColumns = array('id', 'receiptno', 'bankname','amount','status');
    $sIndexColumn = "id";
    $editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbill" : "editbill";
    $sTable = "bankstatus";
}

if ($_REQUEST['types'] == 'purchasetable') {
    $aColumns = array('id', 'supplierid','amount');
    $sIndexColumn = "id";
    $editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbill" : "editbill";
    $sTable = "purchase";
}
if ($_REQUEST['types'] == 'suppliertable') {
    $aColumns = array('id','supplierid','suppliername','producttype');
    $sIndexColumn = "id";
    $editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbill" : "editbill";
    $sTable = "supplier";
}

if ($_REQUEST['types'] == 'returnviewtable') {
    $aColumns = array('id', 'customerid', 'receiptno');
    $sIndexColumn = "id";
    $editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbill" : "editbill";
    $sTable = "returnview";
}


if ($_REQUEST['types'] == 'pawnviewtable') {
    $aColumns = array('id', 'customerid', 'receiptno');
    $sIndexColumn = "id";
    $editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbill" : "editbill";
    $sTable = "returnview";
}

if ($_REQUEST['types'] == 'bankpawntable') {
    $aColumns = array('id', 'year', 'status');
    $sIndexColumn = "id";
    $editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbill" : "editbill";
    $sTable = "bankpawn";
}
if ($_REQUEST['types'] == 'stocktable') {
    $aColumns = array('id', 'object_name', 'qty', 'amount','weight');
    $sIndexColumn = "id";
    $sTable = "stocks";
}

/* Declaration table name start here */


if ($_REQUEST['types'] == 'salestable') {
    $aColumns = array('id', 'supplierid','bill_no','amount');
    $sIndexColumn = "id";
    $editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbill" : "editbill";
    $sTable = "sales";
}
/* Declaration table name start here */


if ($_REQUEST['types'] == 'offerstable') {
    $aColumns = array('id', 'offerid','offername','discount','valid_fromdate','valid_todate','status');
    $sIndexColumn = "id";
    $sTable = "offerdetails";
}

if ($_REQUEST['types'] == 'providertable') {
    $aColumns = array('id', 'merchantname', 'status');
    $sIndexColumn = "id";
    $sTable = "provider";
}

if ($_REQUEST['types'] == 'merchanttable') {
    $aColumns = array('id', 'merchantid','merchantname', 'status');
    $sIndexColumn = "id";
    $sTable = "sales_merchant";
}
if ($_REQUEST['types'] == 'servicetable') {
    $aColumns = array('id', 'name', 'status');
    $sIndexColumn = "id";
    $sTable = "service";
}

if ($_REQUEST['types'] == 'areatable') {
    $aColumns = array('id', 'areaname', 'status');
    $sIndexColumn = "id";
    $sTable = "area";
}
if ($_REQUEST['types'] == 'ranktable') {
    $aColumns = array('id', 'name', 'status');
    $sIndexColumn = "id";
    $sTable = "rank";
}
if ($_REQUEST['types'] == 'membershiptable') {
    $aColumns = array('cid', 'membershipid', 'planname','status');
    $sIndexColumn = "cid";
    $sTable = "membership";
}

if ($_REQUEST['types'] == 'customertable') {
    $aColumns = array('cid', 'customerid', 'cname','membership','emailid','mobile','status');
    $sIndexColumn = "cid";
    $sTable = "customer";
}

$aColumns1 = $aColumns;

function fatal_error($sErrorMessage = '') {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
    die($sErrorMessage);
}

$sLimit = "";

if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
    $sLimit = "LIMIT " . intval($_GET['iDisplayStart']) . ", " . intval($_GET['iDisplayLength']);
}

if($_REQUEST['types']=='invoicetable' || $_REQUEST['types']=='jobtable' || $_REQUEST['types']=='paysliptable'){
    $columnss = ['invoicetable'=>'datetime','jobtable'=>'created_date','paysliptable'=>'date'];
    $sOrder = "ORDER BY `".$columnss[$_REQUEST['types']]."` ASC";
}else{
    $sOrder = "ORDER BY `$sIndexColumn` ASC";
}

if (isset($_GET['iSortCol_0'])) {
    $sOrder = "ORDER BY  ";
    if (in_array("order", $aColumns)) {
        $sOrder .= "`order` asc, ";
    } else if (in_array("Order", $aColumns)) {
        $sOrder .= "`Order` asc, ";
    }else if($_REQUEST['types']=='invoicetable' || $_REQUEST['types']=='jobtable' || $_REQUEST['types']=='paysliptable'){
        $columnss = ['invoicetable'=>'datetime','jobtable'=>'created_date','paysliptable'=>'date'];
        $sOrder .= "`".$columnss[$_REQUEST['types']]."` DESC, ";
    }
    for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
        if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
            $sOrder .= "`" . $aColumns[intval($_GET['iSortCol_' . $i])] . "` " . ($_GET['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
        }
        $sOrder = substr_replace($sOrder, "", -2);
        if ($sOrder == "ORDER BY ") {
            $sOrder = " ";
        }
    }
}

$sWhere = "";

if ($_REQUEST['types'] == 'invoicetable' || $_REQUEST['types'] == 'jobtable'  || $_REQUEST['types'] == 'paysliptable') {
    if (isset($_GET['status_filter']) && $_GET['status_filter'] != "") {
        if (strtolower($_GET['status_filter']) == '1') {
            $sWhere .= " AND `status`='1'";
        } else if (strtolower($_GET['status_filter']) == '2') {
            if($_REQUEST['types']=='jobtable'){
                $invcd = $db->prepare("SELECT `jobids` FROM `jobinvoice` WHERE `draft`='0'");
                $invcd->execute();
                $ds = [];
                while($finvc = $invcd->fetch()){
                    $ds[] = implode(',',explode(',',$finvc['jobids']));
                }
                if(empty($ds)){ $ds = array('0'); }
                $ds = array_diff($ds,array(''));
                $sWhere .= " AND (`$sIndexColumn` NOT IN (".implode(',', $ds).") AND `status`='2')";
            }else{
                $sWhere .= " AND `status`='2'";
            }
        }else if (strtolower($_GET['status_filter']) == '3') {
            if($_REQUEST['types']=='jobtable'){
                $invcd = $db->prepare("SELECT `jobids` FROM `jobinvoice` WHERE `draft`='0'");
                $invcd->execute();
                $ds = [];
                while($finvc = $invcd->fetch()){
                    $ds[] = implode(',',explode(',',$finvc['jobids']));
                }
                if(empty($ds)){ $ds = array('0'); }
                $ds = array_diff($ds,array(''));
                $sWhere .= " AND (`$sIndexColumn` IN (".implode(',', $ds).") AND `status`='2')";
            }else{
                $sWhere .= " AND `status`='3'";
            }
        }else if (strtolower($_GET['status_filter']) == 'draft') {
            $sWhere .= " AND `draft`='1'";
        }
    }elseif($_GET['status_filter'] == ""){
        
    }    
}
if(($_REQUEST['types'] == 'invoicetable' || $_REQUEST['types'] == 'jobtable') && $_GET['dateRange']!=''){
    $daates = explode(' to ',$_GET['dateRange']);
    $columnss = ['invoicetable'=>'datetime','jobtable'=>'pickup_date'];
    $sWhere .= " AND (DATE(`".$columnss[$_REQUEST['types']]."`) >= '".date("Y-m-d",strtotime($daates[0]))."' AND DATE(`".$columnss[$_REQUEST['types']]."`) <= '".date("Y-m-d",strtotime($daates[1]))."')";
}


if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
    $sWhere .= " AND (";
    for ($i = 0; $i < count($aColumns); $i++) {
        if(($_REQUEST['types']=='invoicetable' || $_REQUEST['types']=='jobtable') && $aColumns[$i]=='customer'){
            $sWhere .= " `customer` IN (SELECT `cid` FROM `customer` WHERE LOWER(`companyname`) LIKE '%".strtolower($_GET['sSearch'])."%') OR";
        }else if(($_REQUEST['types']=='paysliptable' || $_REQUEST['types']=='paycalculationtable') && $aColumns[$i]=='employee'){
            $sWhere .= " `employee` IN (SELECT `did` FROM `driver` WHERE LOWER(`firstname`) LIKE '%".strtolower($_GET['sSearch'])."%') OR";
        }else if($_REQUEST['types']=='jobtable' && $aColumns[$i]=='status'){        
            $jstatus = ["waiting"=>"1","job complete"=>"2","cancelled"=>"3"];            
            //$sWhere .= " `status`='".$jstatus[strtolower($_GET['sSearch'])]."' OR ";
        }else if($_REQUEST['types']=='paysliptable' && $aColumns[$i]=='status'){        
            $jstatus = ["draft"=>"1","payslip"=>"0"];            
            //$sWhere .= " `draft`='".$jstatus[strtolower($_GET['sSearch'])]."' OR ";
        }else if ($_REQUEST['types'] == 'invoicetable' && $aColumns[$i] == 'status') {
            
        }else if ($_REQUEST['types']=='returntable' && $aColumns[$i] == 'status') {
            if (strtolower($_GET['sSearch']) == 'Pawned') {
                $sWhere .= " `status`='1' OR ";
            } elseif (strtolower($_GET['sSearch']) == 'Returned') {
                $sWhere .= " `status`='0' OR ";
            } else {
                $sWhere .= "";
            }
        }else if ($_REQUEST['types']=='bankstatustable' && $aColumns[$i] == 'status') {
            if (strtolower($_GET['sSearch']) == 'Pawned') {
                $sWhere .= " `status`='1' OR ";
            } elseif (strtolower($_GET['sSearch']) == 'Returned') {
                $sWhere .= " `status`='0' OR ";
            } else {
                $sWhere .= "";
            }
        }else if ($aColumns[$i] == 'status') {
            if (strtolower($_GET['sSearch']) == 'active') {
                $sWhere .= " `status`='1' OR ";
            } elseif (strtolower($_GET['sSearch']) == 'inactive') {
                $sWhere .= " `status`='0' OR ";
            } else {
                $sWhere .= "";
            }
        } else {
            $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . mres($_GET['sSearch']) . "%' OR ";
        }
    }
    $sWhere = substr_replace($sWhere, "", -3);
    $sWhere .= ')';
}

if (($_REQUEST['types'] == 'drivertable') || ($_REQUEST['types'] == 'empcategorytable') || ($_REQUEST['types'] == 'uomtable') || ($_REQUEST['types'] == 'jobtypetable') || ($_REQUEST['types'] == 'customertable') || ($_REQUEST['types'] == 'innercategorytable') || ($_REQUEST['types'] == 'employeegrouptable') || ($_REQUEST['types'] == 'customergrouptable')) {
    $sWhere .= " AND `status`!='2'";
}else if($_REQUEST['types']=='jobtable'){
    $sWhere .= "AND `status`!='4'";
}
else if ($_REQUEST['types'] == 'offerstable') {
  $sWhere .= " `merchant`=".$_SESSION['merchant'];
}

if ($sWhere != '') {
    $sWhere = "WHERE `$sIndexColumn`!='' $sWhere";
}
if ($_REQUEST['types'] == 'paycalculationtable') {
    $sWheree = ($sWhere!='') ? ' AND ' : ' WHERE ';
    $sWhere .= " $sWheree `subject`='Worker Charge' GROUP BY `employee`";
}




$sQuery = "SELECT SQL_CALC_FOUND_ROWS `" . str_replace(",", "`,`", implode(",", $aColumns)) . "` FROM $sTable $sWhere $sOrder $sLimit ";

$rResult = $db->prepare($sQuery);
$rResult->execute();


$sQuery = "SELECT FOUND_ROWS()";

$rResultFilterTotal = $db->prepare($sQuery);
$rResultFilterTotal->execute();

$aResultFilterTotal = $rResultFilterTotal->fetch();
$iFilteredTotal = $aResultFilterTotal[0];

$sQuery = "SELECT COUNT(" . $sIndexColumn . ") FROM $sTable";
$rResultTotal = $db->prepare($sQuery);
$rResultTotal->execute();

$aResultTotal = $rResultTotal->fetch();
$iTotal = $aResultTotal[0];

$output = array(
    "sEcho" => intval($_GET['sEcho']),
    "iTotalRecords" => $iTotal,
    "iTotalDisplayRecords" => $iFilteredTotal,
    "aaData" => array()
);

$ij = 1;
$k = $_GET['iDisplayStart'];

while ($aRow = $rResult->fetch(PDO::FETCH_ASSOC)) {
    $k++;
    $row = array();
    $row1 = '';
    for ($i = 0; $i < count($aColumns1); $i++) {
        if ($_REQUEST['types'] == 'drivertable') {

            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            } elseif ($aColumns1[$i] == 'title') {
                $row1 .= $aRow[$aColumns1[$i]] . ' ';
            } elseif ($aColumns1[$i] == 'firstname') {
                $row1 .= $aRow[$aColumns1[$i]] . ' ';
            } elseif ($aColumns1[$i] == 'lastname') {
                $row1 .= $aRow[$aColumns1[$i]];
                $row[] = $row1;
            } elseif ($aColumns1[$i] == 'status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Active" : "Inactive";
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        } else if ($_REQUEST['types'] == 'pricing1table') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            } elseif ($aColumns1[$i] == 'status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Active" : "Inactive";
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        } else if ($_REQUEST['types'] == 'returntable') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            } elseif ($aColumns1[$i] == 'receiptno') {
                $row[] = getloan('receipt_no', $aRow[$aColumns1[$i]]);
            } elseif ($aColumns1[$i] == 'status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Pawned" : "Returned";
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        }else if ($_REQUEST['types'] == 'stocktable') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            } elseif ($aColumns1[$i] == 'object_name') {
                $row[] = getobjectsilver('objectname', $aRow[$aColumns1[$i]]);
            } elseif ($aColumns1[$i] == 'status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Pawned" : "Returned";
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        } else if ($_REQUEST['types'] == 'additionalchargetable') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            } elseif ($aColumns1[$i] == 'status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Active" : "Inactive";
            } elseif ($aColumns1[$i] == 'charge') {
                $row[] = '$' . number_format($aRow[$aColumns1[$i]],2);
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        } 
        else if ($_REQUEST['types'] == 'providertable') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            } elseif ($aColumns1[$i] == 'merchantname') {
                $row[] = getmerchant('merchantname', $aRow[$aColumns1[$i]]);
            }  elseif ($aColumns1[$i] == 'status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Active" : "Inactive";
            }else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        } 
        else if ($_REQUEST['types'] == 'loantable') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            } elseif ($aColumns1[$i] == 'cusid') {
                $row[] = getcustomer('cusid', $aRow[$aColumns1[$i]]);
            }  
            elseif ($aColumns1[$i] == 'date') {
                $row[] = date("d-m-Y",strtotime($aRow[$aColumns1[$i]]));
            }elseif ($aColumns1[$i] == 'status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Active" : "Inactive";
            }else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        }
        else if ($_REQUEST['types'] == 'customertable') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            }  elseif ($aColumns1[$i] == 'membership') {
                $row[] = getmembership('planname', $aRow[$aColumns1[$i]]);
            }  elseif ($aColumns1[$i] == 'status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Active" : "Inactive";
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        } else if ($_REQUEST['types'] == 'paycalculationtable') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            } elseif ($aColumns1[$i] == 'task_amount_aud') {
                $row[] = '$' . $aRow[$aColumns1[$i]];
            } elseif ($aColumns1[$i] == 'job_id') {
                $row[] = getinvoice('invoiceid', $aRow[$aColumns1[$i]]);
            } elseif ($aColumns1[$i] == 'employee') {
                $row[] = getdriver('firstname', $aRow[$aColumns1[$i]]);
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        }else if ($_REQUEST['types'] == 'paysliptable') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            } elseif ($aColumns1[$i] == 'employee') {
                $row[] = getdriver('firstname', $aRow[$aColumns1[$i]]);
            } elseif ($aColumns1[$i] == 'date') {
                $row[] = date("d-m-Y",strtotime($aRow[$aColumns1[$i]]));
            }elseif ($aColumns1[$i] == 'status') {
                $s1 = '';$s2 = '';
                if ($aRow[$aColumns1[$i]] == '1') {
                    $s1 = 'selected';
                } elseif ($aRow[$aColumns1[$i]] == '2') {
                    $s2 = 'selected';
                } 
                $sts = '<select name="change_status_job" class="form-control" onchange="change_status(this.value,\''.$aRow[$sIndexColumn].'\')">';
                $sts .='<option value="1" '.$s1.'>Not Paid</option>';
                $sts .='<option value="2" '.$s2.'>Paid</option>';
                $sts .='</select>';
                $row[] = $sts;                                
            } elseif ($aColumns1[$i] == 'draft') {
                if($aRow[$aColumns1[$i]]=='1'){
                 $s1 = '';$s2 = '';
                if ($aRow[$aColumns1[$i]] == '1') {
                    $s1 = 'selected';
                } elseif ($aRow[$aColumns1[$i]] == '0') {
                    $s2 = 'selected';
                } 
                $sts = '<select name="change_status_invoice" class="form-control" onchange="change_status_invoice1(this.value,\''.$aRow[$sIndexColumn].'\')">';
                $sts .='<option value="1" '.$s1.'>Draft</option>';
                $sts .='<option value="2" '.$s2.'>Payslip</option>';
                $sts .='</select>';
                $row[] = $sts;    
                }else{
                    $row[] = "Payslip";
                }
                /*if ($aRow[$aColumns1[$i]] == '1') {
                    $row[] = "Draft";
                } else {
                    $row[] = "invoiced";
                }*/
                //$row[] = date("d-m-Y", strtotime($aRow[$aColumns1[$i]]));
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        } elseif ($_REQUEST['types'] == 'ledgertable') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            } elseif ($aColumns1[$i] == 'under') {
                $row[] = getledgergroup('ledgergroupname', $aRow[$aColumns1[$i]]);
            } elseif ($aColumns1[$i] == 'Status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Active" : "Inactive";
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        } elseif ($_REQUEST['types'] == 'subledgertable') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            } elseif ($aColumns1[$i] == 'ledgergroup') {
                $row[] = getledgergroup('ledgergroupname', $aRow[$aColumns1[$i]]);
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        } else if ($_REQUEST['types'] == 'jobtable') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            } elseif ($aColumns1[$i] == 'pickup_date' || $aColumns1[$i] == 'created_date') {
                $row[] = date("d-m-Y", strtotime($aRow[$aColumns1[$i]]));
            } elseif ($aColumns1[$i] == 'customer') {
                $data_customer = 'data-customer="'.$aRow[$aColumns1[$i]].'"';
                $row[] = getcustomer('companyname', $aRow[$aColumns1[$i]]);
            } elseif ($aColumns1[$i] == 'status') {
                $s1 = '';$s2 = '';$s3 = '';
                if ($aRow[$aColumns1[$i]] == '1') {
                    $s1 = 'selected';
                } elseif ($aRow[$aColumns1[$i]] == '2') {
                    $s2 = 'selected';
                } elseif ($aRow[$aColumns1[$i]] == '3') {
                    $s3 = 'selected';
                }
                $sts = '<select name="change_status_job" class="form-control" onchange="change_status(this.value,\''.$aRow[$sIndexColumn].'\')">';
                $sts .='<option value="1" '.$s1.'>Waiting</option>';
                $sts .='<option value="2" '.$s2.'>Job Complete</option>';
                $sts .='<!--<option value="3" '.$s3.'>Cancelled</option>-->';
                $sts .='</select>';
                $row[] = $sts;
                $data_invoiced = '';
                $inv_s = $db->prepare("SELECT `draft` FROM `jobinvoice` WHERE FIND_IN_SET('".$aRow[$sIndexColumn]."',`jobids`)");
                $inv_s->execute();
                if($inv_s->rowCount() > 0){
                    $f = $inv_s->fetch();
                    if($f['draft']=='1'){
                        $data_invoiced = 'data-invoiced="1"';
                        $row[] = 'Draft';
                    } else if($f['draft']=='0') {
                        $data_invoiced = 'data-invoiced="1"';
                        $row[] = 'Invoiced';
                    } else{
                        $row[] = '';
                    }
                }else{
                    $row[] = '';
                }
                
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        } else if ($_REQUEST['types'] == 'invoicetable') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            } elseif ($aColumns1[$i] == 'datetime') {
                $row[] = date("d-m-Y", strtotime($aRow[$aColumns1[$i]]));
            } elseif ($aColumns1[$i] == 'customer') {
                $row[] = getcustomer('companyname', $aRow[$aColumns1[$i]]);
            } elseif ($aColumns1[$i] == 'finalnettotal') {
                $row[] = "$" . number_format($aRow[$aColumns1[$i]],2);
            } elseif ($aColumns1[$i] == 'status') {
                $s1 = '';$s2 = '';
                if ($aRow[$aColumns1[$i]] == '1') {
                    $s1 = 'selected';
                } elseif ($aRow[$aColumns1[$i]] == '2') {
                    $s2 = 'selected';
                } 
                $sts = '<select name="change_status_job" class="form-control" onchange="change_status(this.value,\''.$aRow[$sIndexColumn].'\')">';
                $sts .='<option value="1" '.$s1.'>Not Paid</option>';
                $sts .='<option value="2" '.$s2.'>Paid</option>';
                $sts .='</select>';
                $row[] = $sts;                                
            }elseif ($aColumns1[$i] == 'status') {
                if ($aRow[$aColumns1[$i]] == '2') {
                    $row[] = "Paid";
                } else {
                    $row[] = "Not Paid";
                }
                //$row[] = date("d-m-Y", strtotime($aRow[$aColumns1[$i]]));
            } elseif ($aColumns1[$i] == 'draft') {
                if($aRow[$aColumns1[$i]]=='1'){
                 $s1 = '';$s2 = '';
                if ($aRow[$aColumns1[$i]] == '1') {
                    $s1 = 'selected';
                } elseif ($aRow[$aColumns1[$i]] == '0') {
                    $s2 = 'selected';
                } 
                $sts = '<select name="change_status_invoice" class="form-control" onchange="change_status_invoice1(this.value,\''.$aRow[$sIndexColumn].'\')">';
                $sts .='<option value="1" '.$s1.'>Draft</option>';
                $sts .='<option value="2" '.$s2.'>Invoice</option>';
                $sts .='</select>';
                $row[] = $sts;    
                }else{
                    $row[] = "invoiced";
                }
                /*if ($aRow[$aColumns1[$i]] == '1') {
                    $row[] = "Draft";
                } else {
                    $row[] = "invoiced";
                }*/
                //$row[] = date("d-m-Y", strtotime($aRow[$aColumns1[$i]]));
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        } 
        else if ($_REQUEST['types'] == 'bankstatustable') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            } elseif ($aColumns1[$i] == 'status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Pawned" : "Returned";
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        }else if ($_REQUEST['types'] == 'uom') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            } elseif ($aColumns1[$i] == 'status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Active" : "Inactive";
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        } else if ($_REQUEST['types'] == 'socialmedia') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            } elseif ($aColumns1[$i] == 'status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Active" : "Inactive";
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        } else {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            } elseif ($aColumns1[$i] == 'Status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Active" : "Inactive";
            } elseif ($aColumns1[$i] == 'status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Active" : "Inactive";
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        }
    }
    
     /* View page  change start here */

    if ($_REQUEST['types'] == 'product1table') {
        $row[] = "<i class='fa fa-eye' onclick='javascript:viewthis(" . $aRow[$sIndexColumn] . ");' style='cursor:pointer;'> View</i>";
    } elseif (($_REQUEST['types'] != 'objecttable') && (($_REQUEST['types'] != 'financecustomertbale') && ($_REQUEST['types'] != 'returntable') && ($_REQUEST['types'] != 'billtable') && ($_REQUEST['types'] != 'bankstatustable') && ($_REQUEST['types'] != 'suppliertable')  && ($_REQUEST['types'] != 'purchasetable') && ($_REQUEST['types'] != 'salestable') && ($_REQUEST['types'] != 'silverobjecttable'))) {
        $row[] = "<i class='fa fa-eye' onclick='javascript:viewthis(" . $aRow[$sIndexColumn] . ");' style='cursor:pointer;'> </i>";
    }

     /* Edit page  change start here */
//    if ($_REQUEST['types'] == 'product1table') {
//        $row[] = "<i class='fa fa-edit' onclick='javascript:editthis(" . $aRow[$sIndexColumn] . ");' style='cursor:pointer;'> Edit</i>";
//    } elseif (($_REQUEST['types'] != 'newslettertable') && ($_REQUEST['types'] != 'gifttable' && ($_REQUEST['types'] != 'appointmenttable') && ($_REQUEST['types'] != 'contacttable') && ($_REQUEST['types'] != 'serviceenquirytable')  && ($_REQUEST['types'] != 'registertable') && ($_REQUEST['types'] != 'ordertable') )) {
//       $row[] = "<i class='md md-edit' onclick='javascript:editthis(" . $aRow[$sIndexColumn] . ");' style='cursor:pointer;'> </i>";
//    }
    
    
    /* Edit page  change start here */
    if ($_REQUEST['types'] == 'producttable') {
        $row[] = "<a href='" . $sitename . "products/" . $aRow[$sIndexColumn] . "/editproduct.htm' target='_blank' style='cursor:pointer;'><i class='fa fa-edit' ></i> Edit</a>";
    } else if ($_REQUEST['types'] == 'billtable') {
        $row[] = "<i class='fa fa-refresh' onclick='reset(" . $aRow[$sIndexColumn] . ");' style='cursor:pointer;'></i>";
        $row[] = "<i class='fa fa-edit' onclick='javascript:editthis(" . $aRow[$sIndexColumn] . ");' style='cursor:pointer;'></i>";
    } elseif (($_REQUEST['types'] == 'contacttable') || ($_REQUEST['types'] == 'paycalculationtable') || ($_REQUEST['types'] == 'paysliptable')) {
        if($_REQUEST['types']=='paysliptable'){
            $row[] = "<a class='btn btn-info' title='Print' style='padding: 3px 9px;float:left;' href='".$sitename."MPDF/invoice/payslip.php?id=".$aRow[$sIndexColumn]."' target='_blank'><i class='fa fa-print' style='cursor:pointer;'></i></a>
                    <a class='btn btn-info' title='Send Mail' onclick='sendMails(\"".$aRow[$sIndexColumn]."\")' style='padding: 3px 9px;float:left;margin-left:5px;' href='#'><i class='fa fa-envelope' style='cursor:pointer;'></i></a>";            
        }
        $row[] = "<i class='fa fa-eye' onclick='javascript:editthis(" . $aRow[$sIndexColumn] . ");' style='cursor:pointer;'> </i>";
    } else {       
        $row[] = "<i class='fa fa-edit' onclick='javascript:editthis(" . $aRow[$sIndexColumn] . ");' style='cursor:pointer;'> Edit </i>";
         if($_REQUEST['types']=='invoicetable'){
            $row[] = "<a class='btn btn-info' title='Print' style='padding: 3px 9px;float:left;' href='".$sitename."MPDF/invoice/invoice.php?id=".$aRow[$sIndexColumn]."' target='_blank'><i class='fa fa-print' style='cursor:pointer;'></i></a>
                    <a class='btn btn-info' title='Send Mail' onclick='$(\"#Conatct_Persons_Modal\").modal(\"show\"); show_contacts(\"".$aRow['customer']."\",\"".$aRow[$sIndexColumn]."\");' style='padding: 3px 9px;float:left;margin-left:5px;' href='#'><i class='fa fa-envelope' style='cursor:pointer;'></i></a>";            
        }
    }
    $row[] = '<input type="checkbox"  name="chk[]" id="chk[]" value="' . $aRow[$sIndexColumn] . '" '.$data_invoiced.' '.$data_customer.' />';


    $output['aaData'][] = $row;
    $ij++;
}

echo json_encode($output);
?>
 
