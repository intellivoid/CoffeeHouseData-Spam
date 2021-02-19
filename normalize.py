import os

with open("input.txt") as fp:
    line = fp.readline()
    category = "Unknown"
    data = ""
    cnt = 1
    while line:
        if  cnt == 1:
            category = line.lower().replace('\n', '')
        else:
            data += line + "\n" 
        line = fp.readline()
        cnt += 1
    data = repr(data)[:-3][1:]
    while "  " in data:
        data = data.replace("  ", " ")
    with open("chatrooms/{0}.dat".format(category), "a") as myfile:
        myfile.write(data + "\n")
