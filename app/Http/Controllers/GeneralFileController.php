<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Models\News;
use App\Models\Event;
use App\Models\GeneralFile;
use App\Models\Announcement;
use Illuminate\Http\Request;
use PharIo\Manifest\Exception;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Storage;

class GeneralFileController extends Controller
{
    static function uploadOrDeleteFileNews(Request $request, News $news,)
    {
        try {
            if ($request->add_file_photos) {
                foreach ($request->file('add_file_photos') as $file) {
                    $fileRoot = $file->store("assets/news/$news->id", 'public');
                    GeneralFile::create([
                        'news_id' => $news->id,
                        'file' => $fileRoot,
                        'is_photo' => true,

                    ]);
                }
            }

            if ($request->delete_files) {
                foreach ($request->delete_files as $photo) {
                    GeneralFile::where('file', $photo)->delete();
                    if (Storage::disk('public')->exists($photo)) {
                        Storage::disk('public')->delete($photo);
                    }
                }
            }
        } catch (Exception $e) {
            return ResponseFormatter::error(
                [
                    'message' => $e
                ],
                'Upload News File Failed',
            );
        }
    }

    static function uploadOrDeleteFileFeed(Request $request, Feed $feed,)
    {
        try {
            if ($request->add_file_photos) {
                foreach ($request->file('add_file_photos') as $file) {
                    $fileRoot = $file->store("assets/feed/$feed->id", 'public');
                    GeneralFile::create([
                        'feed_id' => $feed->id,
                        'file' => $fileRoot,
                        'is_photo' => true,
                    ]);
                }
            }

            if ($request->delete_files) {
                foreach ($request->delete_files as $photo) {
                    GeneralFile::where('file', $photo)->delete();
                    if (Storage::disk('public')->exists($photo)) {
                        Storage::disk('public')->delete($photo);
                    }
                }
            }
        } catch (Exception $e) {
            return ResponseFormatter::error(
                [
                    'message' => $e
                ],
                'Upload feed File Failed',
            );
        }
    }


    static function uploadOrDeleteAnnouncement(Request $request, Announcement $model,)
    {
        try {
            if ($request->add_file_photos) {
                foreach ($request->file('add_file_photos') as $file) {
                    $fileRoot = $file->store("assets/announcements/$model->id", 'public');
                    GeneralFile::create([
                        'announcement_id' => $model->id,
                        'file' => $fileRoot,
                        'is_photo' => true,

                    ]);
                }
            }

            if ($request->delete_files) {
                foreach ($request->delete_files as $photo) {
                    GeneralFile::where('file', $photo)->delete();
                    if (Storage::disk('public')->exists($photo)) {
                        Storage::disk('public')->delete($photo);
                    }
                }
            }
        } catch (Exception $e) {
            return ResponseFormatter::error(
                [
                    'message' => $e
                ],
                'Upload Announcement File Failed',
            );
        }
    }


    static function uploadOrDeleteEvent(Request $request, Event $model,)
    {
        try {
            if ($request->add_file_photos) {
                foreach ($request->file('add_file_photos') as $file) {
                    $fileRoot = $file->store("assets/events/$model->id", 'public');
                    GeneralFile::create([
                        'events_id' => $model->id,
                        'file' => $fileRoot,
                        'is_photo' => true,

                    ]);
                }
            }

            if ($request->delete_files) {
                foreach ($request->delete_files as $photo) {
                    GeneralFile::where('file', $photo)->delete();
                    if (Storage::disk('public')->exists($photo)) {
                        Storage::disk('public')->delete($photo);
                    }
                }
            }
        } catch (Exception $e) {
            return ResponseFormatter::error(
                [
                    'message' => $e
                ],
                'Upload Events File Failed',
            );
        }
    }

    
}
