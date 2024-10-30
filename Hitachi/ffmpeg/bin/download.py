from flask import Flask, render_template, request, Response, session
import cv2
import time
import os
import argparse

app = Flask(__name__)
#app.secret_key = 'comfort#123'


@app.route('/', methods=['GET'])
def main():
    #name = request.args['name']
    #session["file"] = name
    return render_template('webcam.html')



def gen(path):
    #Video streaming generator function.
    file_id = str(path)
    print(file_id)
    cap = cv2.VideoCapture(file_id)
    # Read until video is completed
    while cap.isOpened():
        # Capture frame-by-frame
        ret, img = cap.read()
        if ret:
            img = cv2.resize(img, (0, 0), fx=0.75, fy=0.75)
            frame = cv2.imencode('.jpg', img)[1].tobytes()
            yield b'--frame\r\n'b'Content-Type: image/jpeg\r\n\r\n' + frame + b'\r\n'
            time.sleep(0.1)
        else:
            print("capture error")
            continue
            #return render_template("video_play.html")


@app.route('/video_feed', methods=["POST", "GET"])
def video_feed():
    #path = session["file"]
    path ="download.mp4"
    #print("vid ",path)
    return Response(gen(path),
                mimetype='multipart/x-mixed-replace; boundary=frame')
        

app.run(host ='103.72.141.218', port='5008', debug=True, threaded=True, use_reloader=False)
