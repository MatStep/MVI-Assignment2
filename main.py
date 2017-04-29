import urllib2
# If you are using Python 3+, import urllib instead of urllib2

import json 


data =  {

        "Inputs": {

                "input1":
                {
                    "ColumnNames": ["Meno", "Obtiaznost predmetu", "Pocet hodin ucenia", "Znamka"],
                    "Values": [ [ "value", "1", "8", "value" ] ]
                },        },
            "GlobalParameters": {
}
    }

body = str.encode(json.dumps(data))

url = 'https://ussouthcentral.services.azureml.net/workspaces/ace5b24262f340e7b5603a8891d4f4ce/services/daae0ec573474a9e91f790d97ad71c9f/execute?api-version=2.0&details=true'
api_key = 'CluzSBNiRBWbYtt1lmnG5m/sWEpI+09VS9PcuRAOeIUmNSMCL3yp2LcxdtjzyKjmwrPkGlCRXMsXxkV0v4nJDA==' # Replace this with the API key for the web service
headers = {'Content-Type':'application/json', 'Authorization':('Bearer '+ api_key)}

print headers

req = urllib2.Request(url, body, headers) 

try:
    response = urllib2.urlopen(req)

    # If you are using Python 3+, replace urllib2 with urllib.request in the above code:
    # req = urllib.request.Request(url, body, headers) 
    # response = urllib.request.urlopen(req)

    result = response.read()
    print(result) 
except urllib2.HTTPError, error:
    print("The request failed with status code: " + str(error.code))

    # Print the headers - they include the requert ID and the timestamp, which are useful for debugging the failure
    print(error.info())

    print(json.loads(error.read()))       