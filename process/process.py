import string
import re


def has_x_in_student_number(candidate_number):
    return 'X' in candidate_number


def process(center_no_inp, inp='storage/ft_pt.txt', out='storage/prepared_for_analysis.txt'):
    
     
    data = []
    

    with open(inp, "r") as input,  open(out, "w") as output:
        for line in input:
            if not line:
                return None
            line = line.strip()
            line.replace('"', '')

            # Extract candidate number using regex
            match = re.search(r'\b\d{2}[A-Z]{2}\d{6}\b', line)
            if match:
                
                #check for all part time students
                if  has_x_in_student_number(match.group(0)):
                    candidate_number = match.group(0)

                    center_no = candidate_number[3:6]
                    # print(center_no)
                    if center_no_inp in center_no:
                        data.append({"line": line})
                        output.write(line + '\n')
                        
                #print(f"Candidate Number: {candidate_number}")
            
                #print("Candidate Number not found")




    print("Done! Data prepared for analysis")

    return data

    
    










