import './App.css';
import React, { useState, useRef } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';

function App() {

  const [selectedFile, setSelectedFile] = useState(null);

	const [imageLink, setImageLink] = useState(null);

	const [validationError, setValidationError] = useState(null);

	const fileInputRef = useRef(null);

  //set image file upload
	const handleFileChange = (event) => {

		const file = event.target.files[0];
		if(file)
		{
			const allowedExtension = ['.jpg', '.jpeg', '.gif', '.png'];
			const selectedFileExtension = file.name.split('.').pop().toLowerCase();
			if(allowedExtension.includes('.' + selectedFileExtension))
			{
				setSelectedFile(file);
				setValidationError(null);
			}
			else
			{
				setSelectedFile(null);
				setValidationError('Invalid file extension. Please select a file with .jpg or .jpeg or .gif or .png extension.');
				fileInputRef.current.value = '';
			}
		}

	};

	const handleUpload = async() => {
		if(selectedFile)
		{
			const formData = new FormData();
			formData.append('file', selectedFile);
			const response = await fetch('http://localhost:8086/server.php', {
				method : 'POST',
				body : formData
			});

			const responseData = await response.json();
			setImageLink(responseData.image_link);
			fileInputRef.current.value = '';
		}
		else
		{
			setValidationError('Please select a file before uploading.');
		}
	};

  return (
    <div className="container">

        <div className="card">
            <div className="card-header header">Please upload an image</div>
            <div className="card-body">
                <div className="wording row g-3 align-items-center">
                    <div className="col-auto">
                      <label><b>Upload file:</b></label>
                    </div>
                    <div className="col-auto">
                      <input type="file" ref={fileInputRef} onChange={handleFileChange} />
                    </div>
                    <div className="wording col-auto">
                    	<button className=" wording btn btn-success" onClick={handleUpload}>Upload</button>
                    </div>
                </div>
                <div className="row">
                    <div className="col col-2">&nbsp;</div>
                    <div className="col col-3">
                        {validationError && (
                        	<p className="text-danger">{validationError}</p>
                        )}

                        {imageLink && (
                        	<div>
                            <p><b className='wording'>Uploaded Image : </b></p>
                            <img src={imageLink} className="img-fluid img-thumbnail" />
                          </div>
                        )}
                    </div>
                </div>
            </div>
        </div>
     </div>
  );
}

export default App;
