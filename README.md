# XML MERGER

## MERGES XML RUN/RIDE DATA FILES ##

This script will take 2 files and mix elements of one with elements from the other.

**TLDR:**  The code loops through each `<trkpt>` in a GPX file and compares data at the current index with data at the same index in a second similar file. If there's a difference the data in the first file is replaced.

### BACK STORY ###
I tracked a run (using WearOS & GhostRacer, usually very reliable) & on this occasion while doing laps of a field the 3rd & 4th laps were recorded with errors on one side which increased the overall distance and in doing do increased the resulting speed/pace. I could not live with the error...

I found that Runkeeper allowed me to use a GUI to 'push' the route back into position were it was wrong & then I could export the data back to Strava. Great - however it turns out that Runkeeper binned all of the heart rate & cadence data during the process.

So my aim was to merge the correct latitude & longitude points back into my original file which had the heart rate & cadence data.

### CHANGELOG:

- 2019-09-21  
  - v1.0 (initial)  
