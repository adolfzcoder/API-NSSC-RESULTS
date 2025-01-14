# from clean_data import clean_data as cd
# from clean_data import reset_txt as reset
# from clean_data import process_file as process
# from clean_data import clean_missed_data as cmd
 

from process import process as psc
    


from flask import *

import json
import time

app = Flask(__name__)

@app.route('/', methods = ['GET'])

def home_page():
    data_set = {'Page': 'Home',
                'Message': 'Succesfully laoded home page',
                'Timestamp': time.time()}
    json_dump = json.dumps(data_set)
    
    return json_dump

    


@app.route('/user/', methods = ['GET'])

def user_request_page():

    user_query = str(request.args.get('user'))  # /user/?user=USERNAME




    data_set = {'Page': 'Request',
                'Message': f'Succesfully got the request for {user_query}',
                'Timestamp': time.time()}
    json_dump = json.dumps(data_set)
    
    return json_dump



@app.route('/center_no/', methods = ['GET'])

def request_page():

    user_query = str(request.args.get('center_no'))  # /user/?user=USERNAME


    data = psc.process(center_no_inp=user_query)


    #data_set = {'Page': 'Center Number',
                # 'Message': f'Succesfully got the request for {user_query}',
                # 'Timestamp': time.time(),
                # 'Data': data}
    #json_dump = json.dumps(data_set)
    
    return data
    


if __name__ == '__main__':
    app.run(port=5000, debug=True)
# reset.reset_txts()        
# cd.clean_data() 
# cmd.clean_missed_data()



# if '__name__' == '__main__':
#     print("Running main...")
#     # got annoying deleting data every single time i have to run it...so i just made a package for that or module idk, java messin me up fr
#     print("resetting the files")
#     reset.reset_txts()    
#     print("cleaning the data")
#     cd.clean_data()
    
    
#     print("Outputting the cleaned data to json")
#     process.process_file()
#     print("Done! All data cleaned and written to output file")
    
#     p.process()
    


