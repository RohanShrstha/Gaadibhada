const form = getId('form');

function validate()
{
    if(validateInputs())
    {
        alert("Your post has been submitted, please wait for verify!!");
        form.submit();
    }
    else{
        event.preventDefault();
    }
 
}

function getId(element)
{
    return document.getElementById(element);
}

    
function validateInputs()
{
    const title = getId('title');
    const brand = getId('brand');
    const type = getId('type');
    const description = getId('description');
    const makeyear = getId('makeyear');
    const engine = getId('engine');
    const transmission = getId('transmission');
    const fuel = getId('fuel');
    const mileage = getId('mileage');
    const doors = getId('doors');
    const seats = getId('seats');
    const price = getId('price');
    const selfdrivea = document.getElementsByName('self-drive');
    const selfdrive = getId('selfdrive');
    const img1 = getId('img1');
    const img2 = getId('img2');
    const img3 = getId('img3');
    const img4 = getId('img4');
    const billbookd = getId('billbookd');
    const insuranced = getId('insuranced');

    
    const titleValue = title.value.trim();
    const brandValue = brand.value;
    const typeValue = type.value;
    const descriptionValue = description.value.trim();
    const makeyearValue = makeyear.value.trim();
    const engineValue = engine.value.trim();
    const transmissionValue = transmission.value;
    const fuelValue = fuel.value;
    const mileageValue = mileage.value.trim();
    const doorsValue = doors.value.trim();
    const seatsValue = seats.value.trim();
    const priceValue = price.value.trim();
    const img1V = img1.value;
    const img2V = img2.value;
    const img3V = img3.value;
    const img4V = img4.value;
    const billbookdV = billbookd.value;
    const insurancedV = insuranced.value;

    var errorCount = 0;
    var c = 0;

    function isEmpty(string)
    {
        if(string.length == 0)
            return true;
        else
            return false;
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

    function isNum(input)
    {
        if(!(input.value.match(/^[0-9]+$/)))
        {
            return false;
        }
        else
            return true;
    }

    function imageCheck(fileInput)
    {
        var count = 0;
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg)$/;
        if(!(allowedExtensions.exec(filePath))){
            setError(fileInput.parentElement,"Please upload images having extensions .jpeg/.jpg only.");
            fileInput.value = '';
            count++;
            return count;
        }
        else
        {
            const fileSize = fileInput.files[0].size / 1024 / 1024;
            if (fileSize > 3) {
                setError(fileInput.parentElement,"Image file cannot be more than 3 MB.");
                fileInput.value = '';
                count++;
                return count;
            }
        }
        return count;
    }   

    function fileCheck(fileInput)
    {
        var count = 0;
        var filePath = fileInput.value;
        var allowedExtensions = /(\.pdf|\.docx|\.doc)$/;
        if(!allowedExtensions.exec(filePath)){
            setError(billbookd.parentElement,"Please upload file having extensions .pdf/.docx/.doc only.");
            fileInput.value = '';
            count++;
            return count;
        }
        else
        {
            const fileSize = fileInput.files[0].size / 1024 / 1024;
            if (fileSize > 3) {
                alert('File size exceeds 3 MB');
                fileInput.value = '';
                count++;
                return count;
            }
        }
        return count;
    }

    if(isEmpty(titleValue))
    {
        setError(title,'Title cannot be empty');
        title.focus();
        errorCount ++;
        return false;
    }
    else if(titleValue.length > 20)
    {
        setError(title,'Title cannot be more than 20 characters');
        title.focus();
        errorCount ++;
        return false;
    }
    else{
        setSuccess(title);
    }
    if(brandValue == 0)
    {
        setError(brand,"Select Brand");
        brand.focus();
        errorCount ++;
        return false;
    }
    else
    {
        setSuccess(brand);
    }
    if(typeValue == 0)
    {
        setError(type,"Select Type");
        type.focus();
        errorCount ++;
        return false;
    }
    else
    {
        setSuccess(type);
    }
    if(isEmpty(descriptionValue))
    {
        setError(description,'Description cannot be empty');
        description.focus();
        errorCount ++;
        return false;
    }
    else if(descriptionValue.length > 200)
    {
        setError(description,'Description cannot be more than 200 characters');
        description.focus();
        errorCount ++;
        return false;
    }
    else{
        setSuccess(description);
    }
    if(isEmpty(makeyearValue))
    {
        setError(makeyear,'Cannot be empty');
        makeyear.focus();
        errorCount ++;
        return false;
    }
    else if(!(isNum(makeyear)))
    {
        setError(makeyear,'Only Numbers Allowed');
        makeyear.focus();
        errorCount++;
        return false;
    }
    else if(!(makeyearValue.match(/^[0-9]{4}$/)))
    {
        setError(makeyear,'Provide valid year (eg 2000)');
        makeyear.focus();
        errorCount++;
        return false;
    }
    else{
        setSuccess(makeyear);
    }
    if(isEmpty(engineValue))
    {
        setError(engine,'Cannot be empty');
        engine.focus();
        errorCount ++;
        return false;
    }
    else if(!(isNum(engine)))
    {
        setError(engine,'Only Numbers Allowed');
        engine.focus();
        errorCount++;
        return false;
    }
    else{
        setSuccess(engine);
    }
    if(transmissionValue == 0)
    {
        setError(transmission,"Select Transmission");
        transmission.focus();
        errorCount ++;
        return false;
    }
    else
    {
        setSuccess(transmission);
    }
    if(fuelValue == 0)
    {
        setError(fuel,"Select Fuel");
        fuel.focus();
        errorCount ++;
        return false;
    }
    else
    {
        setSuccess(fuel);
    }
    if(isEmpty(mileageValue))
    {
        setError(mileage,'Cannot be empty');
        mileage.focus();
        errorCount ++;
        return false;
    }
    else if(!(isNum(mileage)))
    {
        setError(mileage,'Only Numbers Allowed');
        mileage.focus();
        errorCount++;
        return false;
    }
    else{
        setSuccess(mileage);
    }
    if(isEmpty(doorsValue))
    {
        setError(doors,'Cannot be empty');
        doors.focus();
        errorCount ++;
        return false;
    }
    else if(!(isNum(doors)))
    {
        setError(doors,'Only Numbers Allowed');
        doors.focus();
        errorCount++;
        return false;
    }
    else{
        setSuccess(doors);
    }
    if(isEmpty(seatsValue))
    {
        setError(seats,'Cannot be empty');
        seats.focus();
        errorCount ++;
        return false;
    }
    else if(!(isNum(seats)))
    {
        setError(seats,'Only Numbers Allowed');
        seats.focus();
        errorCount++;
        return false;
    }
    else{
        setSuccess(seats);
    }
    if(isEmpty(priceValue))
    {
        setError(price,'Cannot be empty');
        price.focus();
        errorCount ++;
        return false;
    }
    else if(!(isNum(price)))
    {
        setError(price,'Only Numbers Allowed');
        price.focus();
        errorCount++;
        return false;
    }
    else if(priceValue == '0')
    {
        setError(price,'Cannot be zero');
        price.focus();
        errorCount ++;
        return false;
    }
    else{
        setSuccess(price);
    }
    if(!(selfdrivea[0].checked || selfdrivea[1].checked))
    {
        setError(selfdrive,'Select an option!');
        errorCount ++;
        return false;
    }
    else{
        setSuccess(selfdrive);
    }

    if(!(isEmpty(img1V)) || !(isEmpty(img2V)) || !(isEmpty(img3V)) || !(isEmpty(img4V)))
    {
        if(!isEmpty(img1V))
        {
            c += imageCheck(img1);
            errorCount += c;
        }
        if(!isEmpty(img2V))
        {
            c += imageCheck(img2);
            errorCount += c;
        }
        if(!isEmpty(img3V))
        {
            c += imageCheck(img3);
            errorCount += c;
        }
        if(!isEmpty(img4V))
        {
            c += imageCheck(img4);
            errorCount += c;
        }
        if(c == 0)
        {
            setSuccess(img1.parentElement);
        }
    }
    else
    {
        setError(img1.parentElement,'Must upload image1');
        errorCount ++;
    }


    if(!(isEmpty(billbookdV)) && !(isEmpty(insurancedV)) )
    {
        c = 0;
        c += fileCheck(billbookd);
        c += fileCheck(insuranced);

        errorCount += c;
        
        if(c == 0)
        {
            setSuccess(billbookd.parentElement);
        }
    }
    else
    {
        setError(billbookd.parentElement,"Please provide both information");
        errorCount ++;
    }
    if(errorCount > 0)
    {
        return false;
    }
    else
    {
        return true;
    }

}