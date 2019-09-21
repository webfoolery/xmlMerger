<?php
$sourceFile = './SOURCE_FILE_NAME.gpx';
$secondFile = './SECOND_FILE_NAME.gpx';
$exportFile = './_FINAL_FIXED.gpx';

$sourceXML = simplexml_load_file($sourceFile) or die("Error: Cannot load source file");
$secondXML = simplexml_load_file($secondFile) or die("Error: Cannot load second file");
$loopCounter = $latCount = $lonCount = 0;
$output = [];
foreach ($sourceXML->trk->trkseg->trkpt as $key) {
    // THIS EXAMPLE REPLACES LAT/LON DATA IN $sourceXML WITH THE DATA FROM $secondXML
    $sourceXMLLat = $sourceXML->trk->trkseg->trkpt[$loopCounter]['lat'];
    $sourceXMLLon = $sourceXML->trk->trkseg->trkpt[$loopCounter]['lon'];
    // MY $secondXML HAD EXTRA DECIMAL PLACES ON LT/LON, NEED TO CROP THAT
    $secondXMLLat = substr($secondXML->trk->trkseg->trkpt[$loopCounter]['lat'], 0, -2);
    $secondXMLLon = substr($secondXML->trk->trkseg->trkpt[$loopCounter]['lon'], 0, -2);
    if ($secondXMLLat && $sourceXMLLat != $secondXMLLat) {
        $output[] = 'LAT #'.$loopCounter.': '.$sourceXMLLat.'=>'.$secondXMLLat;
        $sourceXML->trk->trkseg->trkpt[$loopCounter]['lat'] = $secondXML->trk->trkseg->trkpt[$loopCounter]['lat'];
        $latCount++;
    }
    if ($secondXMLLon && $sourceXMLLon != $secondXMLLon) {
        $output[] = 'LON #'.$loopCounter.': '.$sourceXMLLon.'=>'.$secondXMLLon;
        $sourceXML->trk->trkseg->trkpt[$loopCounter]['lon'] = $secondXML->trk->trkseg->trkpt[$loopCounter]['lon'];
        $lonCount++;
    }
    $loopCounter++;
}
$message = array(
    'Found/checked '.$loopCounter.' points in '.$sourceFile, 
    'Changed '.$latCount.' latitude and '.$lonCount.' longitude.'
);
if ($sourceXML->asXML($exportFile)) $message[] = 'Result saved to '.$exportFile;
else $message[] = 'Failed to save result as '.$exportFile;
$message[] = '<hr />';
$output = array_merge($message, $output);
echo implode('<br />', $output);
