function isvalid()
            {
                if(reserveValidate())
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            function reserveValidate()
            {

                const sdate = document.getElementById('sdate');
                const stime = document.getElementById('stime');
                const edate = document.getElementById('edate');
                const etime = document.getElementById('etime');
                const location = document.getElementById('location');
                const message = document.getElementById('message');

                const sdateV = sdate.value;
                const stimeV = stime.value;
                const etimeV = etime.value;
                const edateV = edate.value;
                const locationV = location.value;
                const messageV = message.value;

                function isEmpty(element)
                {
                    if(element.length == 0)
                    {
                        return true;
                    } 
                    else{
                        return false;
                    }
                }  
                
                function setError(element,msg)
                {
                    const inputBox = element.parentElement;
                    const errorDisplay = inputBox.querySelector('.msg');

                    errorDisplay.innerText = msg;
                    errorDisplay.classList.add('error');
                }

                function setSuccess(element)
                {
                    const inputBox = element.parentElement;
                    const errorDisplay = inputBox.querySelector('.msg');

                    errorDisplay.innerText = "";
                    errorDisplay.classList.remove('error');
                }
                
               

                if(isEmpty(sdateV))
                {
                    setError(sdate,'Starting date cannot be empty');
                    sdate.focus();
                    return false;
                }
                
                else
                {
                    var sdateArray = sdateV.split('-');

                    var currentDate = new Date();
                    var cYear = currentDate.getFullYear();
                    var cMonth = ("0" + (currentDate.getMonth() + 1)).slice(-2);
                    var cDate = ("0" + currentDate.getDate()).slice(-2);

                    if(parseInt(sdateArray[0]) < parseInt(cYear))
                    {
                        setError(sdate,'Please select valid Year');
                        sdate.focus();
                        return false;
                    }
                    else
                    {
                        if(parseInt(sdateArray[1]) < parseInt(cMonth))
                        {
                            setError(sdate,'Please select valid Month');
                            sdate.focus();
                            return false;
                        }
                        else if(parseInt(sdateArray[1]) > parseInt(cMonth))
                        {
                            setSuccess(sdate);
                        }
                        else
                        {
                            if(parseInt(sdateArray[2]) <= parseInt(cDate))
                            {
                                
                                setError(sdate,'Please select valid Day.\nNot able to select today and previous dates.');
                                sdate.focus();
                                return false;
                            }
                            else
                            {
                                setSuccess(sdate);
                            }
                        }
                    }
                }
                
                if(isEmpty(stimeV))
                {
                    setError(stime,'Starting time cannot be empty');
                    stime.focus();
                    return false;
                }
                else
                {
                    var stimearray = stimeV.split(':');
                    if(parseInt(stimearray[0])<6 || parseInt(stimearray[0])>18 || (parseInt(stimearray[0]) == 18 && parseInt(stimearray['1']) > 0))
                    {
                        setError(stime,'Select time between 6: 00 AM and 6: 00 PM');
                        stime.focus();
                        return false;
                    }
                    else
                    {
                        setSuccess(stime);
                    }
                }

                if(isEmpty(edateV))
                {
                    setError(edate,'Ending date cannot be empty');
                    edate.focus();
                    return false;
                }
                else
                {
                    var edateArray = edateV.split('-');

                    if((parseInt(edateArray[0])< parseInt(sdateArray[0])) || (parseInt(edateArray[1])< parseInt(sdateArray[1])))
                    {
                        // console.log(parseInt(edateArray[2]));
                        setError(edate,'Please select valid Date');
                        edate.focus();
                        return false;
                    }
                    else if((parseInt(edateArray[1]) == parseInt(sdateArray[1]))&&(parseInt(edateArray[2])< parseInt(sdateArray[2])))
                    {
                        setError(edate,'Please insert valid Day');
                        edate.focus();
                        return false;
                    }
                    else
                    {
                        setSuccess(edate);
                    }
                   
                }

                if(isEmpty(etimeV))
                {
                    setError(etime,'Ending time cannot be empty');
                    etime.focus();
                    return false;
                }
                else
                {
                    var etimearray = etimeV.split(':');
                    if(parseInt(etimearray[0])<6 || parseInt(etimearray[0])>18 || (parseInt(etimearray[0]) == 18 && parseInt(etimearray['1']) > 0))
                    {
                        setError(etime,'Select time between 6: 00 AM and 6: 00 PM');
                        etime.focus();
                        return false;
                    }
                    else if(parseInt(sdateArray[2]) == parseInt(edateArray[2]) && ((parseInt(stimearray[0])> parseInt(etimearray[0])) || ((parseInt(stimearray[0]) == parseInt(etimearray[0])) && (parseInt(stimearray[1]) == parseInt(etimearray[1])))))
                    {
                        setError(etime,'Select valid starting and ending time');
                        etime.focus();
                        return false;
                    }
                    else if(parseInt(sdateArray[2]) == parseInt(edateArray[2]) && ((parseInt(etimearray[0])*60+(parseInt(etimearray[1])))-(parseInt(stimearray[0])*60+(parseInt(stimearray[1])))<360))
                    {
                        setError(etime,'Booking period should be atleast of 6 hours');
                        etime.focus();
                        return false;
                    }
                    else
                    {
                        setSuccess(etime);
                    }
                    
                }
                

                if(isEmpty(locationV))
                {
                    setError(location,'This field cannot be empty');
                    location.focus();
                    return false;
                }
                else if(locationV.length > 100)
                {
                    setError(location,'Address cannot be more than 100 characters');
                    location.focus();
                    return false;
                }
                else
                {
                    setSuccess(location);
                }

                const drive = document.getElementById('driveoption');
                if(drive)
                {
                    const driveN = document.getElementsByName('driveoption');
                    const driveV = drive.value;
                    if(!(driveN[0].checked || driveN[1].checked))
                    {
                        setError(drive,'Select an option!');
                        return false;
                    }
                    else{
                        setSuccess(drive);
                    }
                }

                if(messageV.length > 100)
                {
                    setError(message,'Message cannot be more than 100 characters');
                    message.focus();
                    return false;
                }
                else
                {
                    setSuccess(message);
                }
                
            }