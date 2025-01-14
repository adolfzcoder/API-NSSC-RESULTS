### This reprository shows how the api to get results of student based on center number.

Center number in candidate number for NSSCO & NSSCAS are from index 3 to 6 ( exluding 6) [3:6}
eg for candidate number 21AA050055 the center number is A05

### How to use API

`Data is returned in JSON`

### Attach /center_no/?center_no=[CENTER NUMBER] to the end of the ngrok url, this will return the querried or requested data

I am using ngrok,
{NGROK URL}/center_no/?center_no={DATA}



          {NGROK URL}                        {ROUTE}      {DATA}
https://2dd4-41-182-169-3.ngrok-free.app/center_no/?center_no=X51


### How it works

`main.py`  

### @app.route('/center_no/', methods = ['GET'])
that allows data to be sent to this using GET method, the data is extracted using:     

### user_query = str(request.args.get('center_no'))  
that is then stored as user_querry and then used as input to the process function

###    data = psc.process(center_no_inp=user_query)

The `process` module contains process.py, that is imported to main.py

The function process accepts center number as input (center_no_inp), the input file, and the output file

### def process(center_no_inp, inp='storage/ft_pt.txt', out='storage/prepared_for_analysis.txt'):


When reading the lines, the script makes extracts th candidate number from the line

###  candidate_number = match.group(0)


(For my use case, i needed to have part time candidates, ie which have an 'X' in their candidate number, this can be commented out when implementing on your own)

### #check for all part time students
###                if  has_x_in_student_number(match.group(0)):

Data is then written to the output file, and returned as a json


### How to use setup ngrok

I am using ngrok, for you to do this follow these steps
1. Create ngrok account
2. Do `pip install pyngrok` (in command prompt)
3. Run `ngrok config add-authtoken [Your AUth Token]` (in command prompt)
4. Finally run `ngrok http 80`


