import os
import time
import psutil  # Add this import for process management
from pydub import AudioSegment

audio_folder = "audio"

def is_longer_than_5s(file_path):
    audio = AudioSegment.from_file(file_path)
    return len(audio) > 5000  # 5000 milliseconds = 5 seconds

def terminate_gtts_process():
    for process in psutil.process_iter(['pid', 'name']):
        if 'gtts-cli' in process.info['name']:
            print(f"Terminating gtts-cli process (PID {process.info['pid']})")
            psutil.Process(process.info['pid']).terminate()

def delete_files_longer_than_5s(folder):
    for filename in os.listdir(folder):
        file_path = os.path.join(folder, filename)
        if filename.endswith(".mp3") and is_longer_than_5s(file_path):
            terminate_gtts_process()
            os.remove(file_path)
            print(f"Deleted: {filename}")

if __name__ == "__main__":
    while True:
        delete_files_longer_than_5s(audio_folder)
        time.sleep(1)  # Check every second
